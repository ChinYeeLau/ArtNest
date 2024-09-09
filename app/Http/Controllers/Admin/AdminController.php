<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Session;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\VendorsBankDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\VendorsBusinessDetail;
use Intervention\Image\Facades\Image;

class AdminController extends Controller

{
    public function dashboard(){
        Session::put('page','dashboard');
        
            // Get the current admin
            $admin = Auth::guard('admin')->user();
            $adminType = $admin->type;
            $vendorId = $admin->vendor_id;
        
            // Get counts for various entities
            $sectionsCount = Section::count();
            $categoriesCount = Category::count();
        
            if ($adminType == "vendor") {
                // For vendor type admins, filter counts by vendor_id
                $productsCount = Product::where('vendor_id', $vendorId)->count();
                $ordersCount = Order::whereHas('orders_products', function ($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })->count();
            } else {
                // For other admin types, show totals across all vendors
                $productsCount = Product::count();
                $ordersCount = Order::count();
            }
        
            $couponsCount = Coupon::count();
            $usersCount = User::count();
            $subscribersCount = NewsletterSubscriber::count();
   // Get the current admin
   $admin = Auth::guard('admin')->user();
   $adminId = $admin->id;
   $adminType = $admin->type;
   $vendorId = $admin->vendor_id;

   // Fetch monthly totals based on product price and quantity where admin_id matches
   $monthlyTotals = DB::table('orders_products')
       ->where('admin_id', $adminId) // Ensure this column exists in orders_products
       ->join('orders', 'orders.id', '=', 'orders_products.order_id') // Join to get created_at
       ->selectRaw('MONTH(orders.created_at) as month, SUM(orders_products.product_price * orders_products.product_qty) as total')
       ->groupBy('month')
       ->orderBy('month')
       ->pluck('total', 'month')
       ->toArray();

   // Initialize an array with 12 zeros, one for each month
   $yValues = array_fill(0, 12, 0);

   // Populate the yValues array with actual totals from the database
   foreach ($monthlyTotals as $month => $total) {
       $yValues[$month - 1] = $total; // Adjust month index for zero-based array
   }

   // Fetch recent orders based on vendor ID for vendor type
   if ($adminType == "vendor") {
       $orders = Order::whereHas('orders_products', function($query) use ($vendorId) {
           $query->where('vendor_id', $vendorId);
       })
       ->orderBy('created_at', 'desc')
       ->get();
   } else {
       // Fetch all orders for other admin types
       $orders = Order::with('orders_products')
           ->orderBy('created_at', 'desc')
           ->get();
   }
   // Fetch products based on vendor ID for vendor type
   $products = Product::with(['section' => function ($query) {
    $query->select('id', 'name');
}, 'category' => function ($query) {
    $query->select('id', 'category_name');
}]);

if ($adminType == "vendor") {
    $products = $products->where('vendor_id', $vendorId) ->limit(2)->orderBy('created_at', 'desc');
}

$products = $products->get();


   return view('admin.dashboard')->with(compact('sectionsCount', 'categoriesCount', 'productsCount', 'couponsCount','ordersCount', 'usersCount', 'subscribersCount', 'yValues', 'orders','products' ));
}

    public function updateAdminPassword(Request $request){
        Session::put('page','update_admin_password');
        if($request->isMethod('post')){
            $data=$request->all();
            /*echo"<pre>";print_r($data);die;*/
            //Check if current password enter by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //Check is the confirm password correct 
                if($data['confirm_password']==$data['new_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                }else {
                return redirect()->back()->with('error_message', 'New Password and Confirm Password does not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your Current Password is Incorrect!');
            
            }
        
        }
        /*echo"<pre>";print_r(Auth::guard('admin')->user());die;*/
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }
  
    public function checkAdminPassword(Request $request){
        $data=$request->all();
        /*echo"<pre>";print_r($data);die;*/
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }


    }

    public function updateAdminDetails(Request $request)
    {
        Session::put('page','update_admin_details');
        if($request->isMethod('post')){
            $data=$request->all();
        /*echo"<pre>";print_r($data);die;*/
        $rules=[
            'admin_name'=>'required|regex:/^[\pL\s\-]+$/u',
            'admin_mobile'=>'required|numeric',
        ];

        $customMessages=[
            'admin_name.required'=>'Name is required',
            'admin_name.regex'=>'Valid Name is required',
            'admin_mobile.required'=>'Mobile is required',
            'admin_mobile.numeric'=>'Valid Mobile is required',

        ];
    
        $this->validate($request,$rules,$customMessages);
        
        //Upload AdminPhoto
        if($request->hasFile('admin_image')){

        
            $image_tmp=$request->file('admin_image');
            if ($image_tmp->isValid()){
                //get image extension
                $extension=$image_tmp->getClientOriginalExtension();
                //Generate new image name
                 $imageName=rand(111,99999).'.'.$extension;
                $imagePath='admin/images/photos/'.$imageName;
               //upload the image
               Image::make($image_tmp)->save($imagePath);
            }
        }elseif(!empty($data['current_admin_image'])){
            $imageName= $data['current_admin_image'];
            
        }else{
            $imageName="";
        }
        
        //update details
       
        Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'],'image'=>$imageName]);
        
        return redirect()->back()->with('success_message','Admin details updated successfully!');
    }
    
        return view('admin.settings.update_admin_details');
     }
    
     public function updateVendorDetails($slug,Request $request){


        if($slug=="personal"){
            Session::put('page','update_personal_details');
            if($request->isMethod('post')){
                $data=$request->all();
                /*echo"<pre>";print_r($data);die;*/
                $rules=[
                    'vendor_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_state'=>'required',
                    'vendor_mobile'=>'required|numeric',
                    'vendor_current_status'=>'required',
                ];
        
                $customMessages=[
                    'vendor_name.required'=>'Name is required',
                    'vendor_name.regex'=>'Valid Name is required',
                    'vendor_state.required'=>'State is required',
                    'vendor_state.regex'=>'Valid State is required',
                    'vendor_mobile.required'=>'Mobile is required',
                    'vendor_mobile.numeric'=>'Valid Mobile is required',
                    'vendor_current_status.required'=>'Valid current status is required',
                ];
            
                $this->validate($request,$rules,$customMessages);
                
                //Upload AdminPhoto
                if($request->hasFile('vendor_image')){
        
                
                    $image_tmp=$request->file('vendor_image');
                    if ($image_tmp->isValid()){
                        //get image extension
                        $extension=$image_tmp->getClientOriginalExtension();
                        //Generate new image name
                         $imageName=rand(111,99999).'.'.$extension;
                        $imagePath='admin/images/photos/'.$imageName;
                       //upload the image
                       Image::make($image_tmp)->save($imagePath);
                    }
                }elseif(!empty($data['current_vendor_image'])){
                    $imageName= $data['current_vendor_image'];
                    
                }else{
                    $imageName="";
                }
              
                //update in admins tables
               
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'],'image'=>$imageName]);
                //update in vendors table
                Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(['name' => $data['vendor_name'], 'state' => $data['vendor_state'],'mobile' => $data['vendor_mobile'],'current_status'=>$data['vendor_current_status'],'portfolio'=>$data['vendor_portfolio']]);
                return redirect()->back()->with('success_message','Vendor details updated successfully!');
            
                
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        }else if($slug=="business"){
            Session::put('page','update_business_details');
            if($request->isMethod('post')){
                $data=$request->all();
                //echo"<pre>";print_r($data);die;
                $rules=[
                    'shop_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'shop_state'=>'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile'=>'required|numeric',
                    'shop_email'=>'required|email|max:255',
                ];
        
                $customMessages=[
                    'shop_name.required'=>'Name is required',
                    'shop_name.regex'=>'Valid Name is required',
                    'shop_state.required'=>'State is required',
                    'shop_state.regex'=>'Valid State is required',
                    'shop_mobile.required'=>'Mobile is required',
                    'shop_mobile.numeric'=>'Valid Mobile is required',
                    'shop_email.required'=>'Email is required',
                    'shop_email.email'=>'Valid Email is required',
        
                ];
            
                $this->validate($request,$rules,$customMessages);
                
              
                $vendorCount=  VendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->count();
                if($vendorCount>0){
                    VendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['shop_name' => $data['shop_name'], 'shop_state' => $data['shop_state'],'shop_mobile' => $data['shop_mobile'],'shop_website' => $data['shop_website'],'shop_email' => $data['shop_email']]);

                }else{

                
                VendorsBusinessDetail::insert(['vendor_id'=>Auth::guard('admin')->user()->vendor_id,'shop_name' => $data['shop_name'], 'shop_state' => $data['shop_state'],'shop_mobile' => $data['shop_mobile'],'shop_website' => $data['shop_website'],'shop_email' => $data['shop_email']]);
                }
                return redirect()->back()->with('success_message','Shop details updated successfully!');

            }
            $vendorCount=$vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
              if($vendorCount>0){
                $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

              }else{
                $vendorDetails=array();
              }
           
         


        }else if($slug=="bank"){
            Session::put('page','update_bank_details');
            if($request->isMethod('post')){
                $data=$request->all();
                /*echo"<pre>";print_r($data);die;*/
                $rules=[
                    'account_holder_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name'=>'required|regex:/^[\pL\s\-]+$/u',
                    'account_number'=>'required|numeric',
            
                ];
        
                $customMessages=[
                    'account_holder_name.required'=>'Account Holder Name is required',
                    'account_holder_name.regex'=>'Valid Account Holder Name is required',
                    'bank_name.required'=>'Bank Name is required',
                    'bank_name.regex'=>'Bank Name is required',
                    'account_number.required'=>'Account Number is required',
                    'account_number.numeric'=>'Valid Account Number is required',
        
        
                ];
            
                $this->validate($request,$rules,$customMessages);
                
                //Upload AdminPhoto
                $vendorCount=   VendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->count();
                if($vendorCount>0){
                    VendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'],'account_number' => $data['account_number']]);

                }else{

                
                    VendorsBankDetail::insert(['vendor_id'=>Auth::guard('admin')->user()->vendor_id,'account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'],'account_number' => $data['account_number']]);
                }
                
                return redirect()->back()->with('success_message','Bank details updated successfully!');
            
                
            }
            $vendorCount= $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if($vendorCount>0){
              
                $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

              }else{
                $vendorDetails=array();
              }
           
            
        }
        return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails'));
     }
    
     public function login(Request $request){
        
        //echo $password = Hash::make('123456'); die;

        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $rules=[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
               $customMessages=[
                //Add Custom Message here
                'email.required'=>'Email is required',
                'email.email'=>'Valid Email is required',
                'password.required'=>'Password is required',
               ];
              $this->validate ($request,$rules,$customMessages);
           /* if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }*/
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                if(Auth::guard('admin')->user()->type=="vendor"&&Auth::guard('admin')->user()->confirm=="No"){
                    return redirect()->back()->with('error_message','Please confirm your email to activate your Vendor Account');
                }elseif(Auth::guard('admin')->user()->type!="vendor"&&Auth::guard('admin')->user()->status=="0"){
                    return redirect()->back()->with('error_message','Your admin account is not active.');

                }else{}
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }

        }
        return view('admin.login');
    }
    public function admins($type=null){
        $admins=Admin::query();
        if(!empty($type)){
            $admins=$admins->where('type',$type);
            $title=ucfirst($type)."s";
            Session::put('page', 'view_' . strtolower($title));
        }else{
            $title="All Admins/Vendors";
            Session::put('page','view_all');
        }
        $admins=$admins->get()->toArray();
        /*dd($admins);*/
        return view('admin.admins.admins')->with(compact('admins','title'));

    }
    public function viewVendorDetails($id){
        Session::put('page','view_vendor_details');
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        //dd($vendorDetails);
        $vendorDetails=json_decode(json_encode($vendorDetails),true);
      
        
        return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));

    }
    public function updateAdminStatus(Request $request){
        Session::put('page','view_admins');
        if($request->ajax()){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            $adminDetails = Admin::where('id',$data['admin_id'])->first()->toArray();
            if($adminDetails['type']=="vendor" && $status==1){
          Vendor::where('id',$adminDetails['vendor_id'])->update(['status'=>$status]);
             //send Approval email
        $email=$adminDetails['email'];
        $messageData=[
       'email'=>$adminDetails['email'],
       'name'=>$adminDetails['name'],
       'mobile'=>$adminDetails['mobile'],
      ];
      
       Mail::send('emails.vendor_approved',$messageData,function($message)use($email){
       $message->to($email)->subject('Vendor Account is Approved');
       });
           }
            
            
            return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
            
        }

    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
  
}
