<?php

namespace App\Http\Controllers\Front;

use DB;
use Auth;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrdersProducts;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\DeliveryAddress;
use App\Models\ProductsAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class ProductsController extends Controller
{
    public function listing(Request $request){
      if($request->ajax()){
         $data=$request->all();
         /*echo "<pre>";print_r($data);die;*/
         $url=$data['url'];
         $_GET['sort']=$data['sort'];
         $categoryCount=Category::where(['url'=>$url,'status'=>1])->count();
         if ($categoryCount>0){
            //get category detail
            $categoryDetails=Category::categoryDetails($url);

            //$categoryProducts=Product::whereIn('category_id',$categoryDetails['catIds'])->where('status',1)->get()->toArray();
            $categoryProducts=Product::whereIn('category_id',$categoryDetails['catIds'])->where('status',1);

            //checking for filters
            $productFilters=ProductsFilter::productFilters();
            foreach($productFilters as $key =>$filter){
             //if filter selected
             if(isset($filter['filter_column'])&&isset($data[$filter['filter_column']])&&!empty($filter['filter_column'])&&!empty($data[$filter['filter_column']])){
               $categoryProducts->whereIn($filter['filter_column'],$data[$filter['filter_column']]);
             }
            }
          
            /*dd($categoryDetails);*/
            //echo"Category exist";
            //check for sort
            if(isset($_GET ['sort'])&&!empty($_GET['sort'])){
               if($_GET['sort']=="product_latest"){
                  $categoryProducts->orderBy('products.id','Desc');
               }else if($_GET['sort']=="price_lowest"){
                  $categoryProducts->orderBy('products.product_price','Asc');
               }else if($_GET['sort']=="price_highest"){
                  $categoryProducts->orderBy('products.product_price','Desc');
            }else if($_GET['sort']=="name_a_z"){
               $categoryProducts->orderBy('products.product_name','Asc');
            }else if($_GET['sort']=="name_z_a"){
               $categoryProducts->orderBy('products.product_name','Desc');
            }
         }
         //check size
         if (isset($data['size']) && !empty($data['size'])) {
            // Retrieve product IDs based on size
            $productIds = ProductsAttribute::whereIn('size', $data['size'])->pluck('product_id')->toArray();
            // Filter $categoryProducts by product IDs
            $categoryProducts->whereIn('id', $productIds);
        }
         //check color
         if (isset($data['color']) && !empty($data['color'])) {
            // Retrieve product IDs based on color
            $productIds = Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray();
            // Filter $categoryProducts by product IDs
            $categoryProducts->whereIn('id', $productIds);
        }
       /* if (isset($data['price']) && !empty($data['price'])) {
         $productIds = [];
     
         foreach ($data['price'] as $key => $price) {
             $priceArr = explode("-", $price);
             $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
         }
     
         $productIds = array_merge(...$productIds); // Merge all arrays into one
     
         $categoryProducts->whereIn('id', $productIds);
     }*/
     $productIds = array();
     if (isset($data['price']) && !empty($data['price'])) {
         foreach ($data['price'] as $key => $price) {
             $priceArr = explode("-", $price);
             if (isset($priceArr[0]) && isset($priceArr[1])) {
                 $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
             }
         }
         // Flatten the array and remove duplicates
         $productIds = array_unique(array_flatten($productIds));
     
         // Apply the filter outside the loop
         $categoryProducts->whereIn('products.id', $productIds);
     }
     


           $categoryProducts= $categoryProducts->paginate(3);
            return view('front.products.ajax_products_listing')->with(compact('categoryDetails','categoryProducts','url',));
         }else{
            abort(404);
         }
      }else{
         $url=Route::getFacadeRoot()->current()->uri();
         $categoryCount=Category::where(['url'=>$url,'status'=>1])->count();
         if ($categoryCount>0){
            //get category detail
            $categoryDetails=Category::categoryDetails($url);
         
            $categoryProducts=Product::whereIn('category_id',$categoryDetails['catIds'])->where('status',1);
            //dd($categoryProducts);
            //echo"Category exist";
            //check for sort
            if(isset($_GET ['sort'])&&!empty($_GET['sort'])){
               if($_GET['sort']=="product_latest"){
                  $categoryProducts ->orderBy('products.id', 'Desc');
               }else if($_GET['sort']=="name_a_z"){
                  $categoryProducts->orderBy('products.product_name','Asc');
               }else if($_GET['sort']=="name_z_a"){
                  $categoryProducts->orderBy('products.product_name','Desc');
               }else if($_GET['sort']=="price_lowest"){
                  $categoryProducts->orderBy('products.product_price','Asc');
               }else if($_GET['sort']=="price_highest"){
                  $categoryProducts->orderBy('products.product_price','Desc');
            
            }
         }
         $featuredProducts=Product::where('is_featured','Yes')->where('status',1)->limit(4)->inRandomOrder()->get()->toArray();
         $fixBanners=Banner::where('type','Fix')->where('status',1)->get()->toArray();


           $categoryProducts=$categoryProducts->orderBy('products.id', 'asc')->paginate(3);
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts','url','featuredProducts','fixBanners'));
         }else{
            abort(404);
         }

      }
        
    }
    public function vendorListing($vendorid){
      //get vendor shop detail
     $getVendorShop =Vendor::getVendorShop ($vendorid);
      // Get vendor details
    $vendor = Vendor::find($vendorid);
     //get vendor product
     $vendorProducts=Product::where('vendor_id',$vendorid)->where('status',1);
     $vendorProducts=$vendorProducts->paginate(30);

    //dd($vendorProducts);
     return view('front.products.vendor_listing')->with(compact('getVendorShop','vendorProducts','vendor'));
   }
    public function detail($id){
      $productDetails=Product::with(['section','category','vendor','attributes'=>function($query){$query->where('stock','>',0)->where('status',1);},'images'])->find ($id)->toArray();
      $categoryDetails=Category::categoryDetails($productDetails['category']['url']);
      //dd( $productDetails);
      $totalStock=ProductsAttribute::where('product_id',$id)->sum('stock'); 
      return view('front.products.detail')->with(compact('productDetails','categoryDetails','totalStock'));
    }
    public function getProductPrice(Request $request){
        if($request->ajax()){
         $data=$request->all();
        // echo"<pre>";print_r($data);die;
         $getDiscountAttributePrice=Product::getDiscountAttributePrice($data['product_id'],$data['size']);
       return  $getDiscountAttributePrice;
      }
    }
    public function cartAdd(Request $request){
      if($request->isMethod('post')){
         $data=$request->all();
         //echo"<pre>";print_r($data);die;
         //check product stock is available or not
        $getProductStock=ProductsAttribute::getProductStock($data['product_id'],$data['size']);
        if($getProductStock<$data['quantity']){
         return redirect()->back()->with('error_message','Require Quantity is not available');
        }
       // generate session id if not exists
       $session_id=Session::get('session_id');
       if(empty($session_id)){
         $session_id=Session::getId();
         Session::put('session_id',$session_id);
       }
       //check products if already exist in cart
       if (Auth::check()){
         //user is logged in 
          $user_id=Auth::user()->id;
          $countProducts=Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>$user_id])->count();
       }else{
         //user is not loged in 
         $user_id=0;
         $countProducts=Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>$session_id])->count();

       }

       if($countProducts>0){
         return redirect()->back()->with('error_message','Product already exists in Cart!');
       }
       
       //save product in cart table
       $item=new Cart;
       $item->session_id=$session_id;
       $item->user_id=$user_id;
       $item->product_id=$data['product_id'];
       $item->size=$data['size'];
       $item->quantity=$data['quantity'];
       $item->save();
       return redirect()->back()->with('success_message','Product has been added in cart! <a href="/cart">View Cart</a>');
      }

    }

    public function cart(){
      $getCartItems=Cart::getCartItems();
      //dd($getCartItems);
      return view ('front.products.cart')->with(compact('getCartItems'));
    }
    public function cartUpdate(Request $request){
      if($request->ajax()){
         $data=$request->all();
        // echo"<pre>";print_r($data);die;
        //Get Cart Details
        $cartDetails=Cart::find($data['cartid']);
        //Get Available Product Stock
        $availableStock=ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->first()->toArray();
       // echo"<pre>";print_r($availableStock);die;
       //check if desire stock from user is avaiable
        if($data['qty']>$availableStock['stock']){
         $getCartItems =Cart::getCartItems();
         return response()->json([
          'status'=>false,
          'message'=>'Product Stock is not available',
          'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems'))
       ]);
        }
        //check if size is available
        $availableSize=ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=>1])->count();
        if ($availableSize == 0) {
         $getCartItems = Cart::getCartItems();
         return response()->json([
             'status' => false,
             'message' => 'Product Size is not available.Please remove and choose other product.',
             'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems'))
         ]);
     }
        //update the qty

        Cart::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
        $getCartItems =Cart::getCartItems();
        $totalCartItems=totalCartItems();
        Session::forget('couponAmount');
        Session::forget('couponCode');
        return response()->json([
         'status'=>true,
         'totalCartItems'=>$totalCartItems,
         'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),

      ]);
      }

    }
    public function cartDelete(Request $request){
       if ($request->ajax()){
         Session::forget('couponAmount');
         Session::forget('couponCode');
         $data=$request->all();
        // echo"<pre>";print_r($data);die;
         Cart::where('id',$data['cartid'])->delete();
        $getCartItems =Cart::getCartItems();
        $totalCartItems=totalCartItems();
        return response()->json([
         'totalCartItems'=>$totalCartItems,
         'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),

     ]);
       }
    }
    public function applyCoupon(Request $request){
   if($request->ajax()){
      $data=$request->all();
      Session::forget('couponAmount');
      Session::forget('couponCode');
     // echo"<pre>";print_r($data);die;
    $getCartItems =Cart::getCartItems();
      $totalCartItems=totalCartItems();
      $couponCount=Coupon::where('coupon_code',$data['code'])->count();
      if($couponCount==0){
         return response()->json([
            'status'=>false,
            'totalCartItems'=>$totalCartItems,
            'message'=>'The Coupon is not Valid',
         'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems'))

         ]);
      }else{
         //get coupon detail
         $couponDetails=Coupon::where('coupon_code',$data['code'])->first();
         //Check if coupon is active
         if($couponDetails->status==0){
            $message="The coupon is not active!";
         }
         //check coupon is expired
         $expiry_date=$couponDetails->expiry_date;
         $current_date=date('Y-m-d');
         if($expiry_date<$current_date){
            $message="The coupon is expired!";
         }
         //check if coupon is from selected categories
         //get all selected categories from coupon and convert to array
         $catArr=explode(",",$couponDetails->categories);
         //check if any item not belong to the coupon category
         $total_amount=0;
         foreach($getCartItems as $key =>$item){
            if(!in_array($item['product']['category_id'],$catArr)){
               $message="This coupon code is not for one of the selected products.";
            }
            $attrPrice=Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            //echo"<pre>";print_r($attrPrice);die;
            $total_amount=$total_amount+($attrPrice['final_price']*$item['quantity']);
         }
         //check if the coupon is from the selected user
          //get all the selected user from coupon and convert to array
          if (isset($couponDetails->users)&&!empty($couponDetails->users)){
            $usersArr=explode(",",$couponDetails->users);
            if(count($usersArr)){
            //get user id of all selected users
            foreach($usersArr as $key =>$user){
               $getUserId=User::select('id')->where('email',$user)->first()->toArray();
               $usersId[]=$getUserId['id'];
            }
            //check if any item not belong to the coupon user
            foreach($getCartItems as $item){
                    if(!in_array($item['user_id'],$usersId)){
                   $message="This coupon code is not for you.Try with valid coupon code.";
                   }
                 }
              }
          }
         
         if($couponDetails->vendor_id>0){
            $productIds=Product::select('id')->where('vendor_id',$couponDetails->vendor_id)->pluck('id')->toArray();         //check if coupon belong the vendor products
        //echo "<pre>";print_r($productIds);die;
            foreach($getCartItems as $item){
               if(!in_array($item['product']['id'],$productIds)){
                  $message="This coupon code is not for you.Try with valid coupon code.";
                  }
                }
         }
      
         //if error message is there
         if(isset($message)){
            return response()->json([
               'status'=>false,
               'totalCartItems'=>$totalCartItems,
               'message'=>$message,
            'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems'))
            ]);
         }else{
            //coupon code is correct
           //check if coupon amount type is fixed or percentage
           if($couponDetails->amount_type=="Fixed"){
            $couponAmount =$couponDetails->amount;
           }else{
            $couponAmount=$total_amount*($couponDetails->amount/100);
           }
           $grand_total=$total_amount-$couponAmount;
           //add coupon code and amount in session variable
           Session::put('couponAmount',$couponAmount);
           Session::put('couponCode',$data['code']);
           $message="Coupon Code successfully applied.You are availing discount!";
           
           return response()->json([
            'status'=>true,
            'totalCartItems'=>$totalCartItems,
            'couponAmount'=>$couponAmount,
            'grand_total'=> $grand_total,
            'message'=>$message,
         'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems'))
         ]);
         }
      }
   }
    }
    public function checkout(Request $request){
      $deliveryAddresses=DeliveryAddress::deliveryAddresses();
      $getCartItems=Cart::getCartItems();
      //dd($getCartItems);
      if(count($getCartItems)==0){
         $message="Shopping Cart is empty!Please add products to checkout!";
         return redirect('cart')->with('error_message',$message);
      }
      if($request->isMethod('post')){
         $data=$request->all();
        // echo "<pre>";print_r($data);die;
        //delivery address validation
        if(empty($data['address_id'])){
         $message="Please select Delivery Address!";
         return redirect()->back()->with('error_message',$message);
        }
        //payment method validation
        if(empty($data['payment_gateway'])){
         $message="Please select Payment Method!";
         return redirect()->back()->with('error_message',$message);
        }
        //echo "<pre>";print_r($data);die;
        //get delivery address from address_id
        $deliveryAddress=DeliveryAddress::where('id',$data['address_id'])->first()->toArray();
        // dd($deliveryAddress);
         //set payment method as cod if cod selected otherwise set as prepaid
         if($data['payment_gateway']=="COD"){
            $payment_method="COD";
            $order_status="New";
         }else{
            $payment_method="Prepaid";
            $order_status="Pending";
         }

         DB::beginTransaction();
         //calculate total
         $total_price=0;
         foreach($getCartItems as $item){
            $getDiscountAttributePrice=Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            $total_price=$total_price + ($getDiscountAttributePrice['final_price']*$item['quantity']);
         }
         //calculate shipping charges
         $shipping_charges=0;
         //calculate grand total
         $grand_total=$total_price+$shipping_charges-Session::get('couponAmount');
         //insert grand total in session variable
         Session::put('grand_total',$grand_total);
         //insert order detail
         $order= new Order;
         $order->user_id=Auth::user()->id;
         $order->name=$deliveryAddress['name'];
         $order->address=$deliveryAddress['address'];
         $order->state=$deliveryAddress['state'];
         $order->postcode=$deliveryAddress['postcode'];
         $order->mobile=$deliveryAddress['mobile'];
         $order->email=Auth::user()->email;
         $order->shipping_charges=$shipping_charges;
         $order->coupon_code=Session::get('couponCode');
         $order->coupon_amount=Session::get('couponAmount');
         $order->order_status=$order_status;
         $order->payment_method=$payment_method;
         $order->payment_gateway=$data['payment_gateway'];
         $order->grand_total=$grand_total;
         $order->save();
         $order_id=DB::getPdo()->lastInsertId();

         foreach($getCartItems as $item){
            $cartItem=new OrdersProducts;
            $cartItem->order_id=$order_id;
            $cartItem->user_id=Auth::user()->id;
            $getProductDetails=Product::select('product_code','product_name','product_color','admin_id','vendor_id')->where('id',$item['product_id'])->first()->toArray();
            dd($getProductDetails);

         }
         DB::commit();
      }
     
      return view('front.products.checkout')->with(compact('deliveryAddresses','getCartItems'));
    }

   }
