<?php

namespace App\Http\Controllers\Front;

use DB;
use Auth;
use Session;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
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
        if (isset($data['price']) && !empty($data['price'])) {
         $productIds = [];
     
         foreach ($data['price'] as $key => $price) {
             $priceArr = explode("-", $price);
             $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
         }
     
         $productIds = array_merge(...$productIds); // Merge all arrays into one
     
         $categoryProducts->whereIn('id', $productIds);
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
        return response()->json([
         'status'=>true,
         'totalCartItems'=>$totalCartItems,
         'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems'))
      ]);
      }

    }
    public function cartDelete(Request $request){
       if ($request->ajax()){
         $data=$request->all();
        // echo"<pre>";print_r($data);die;
         Cart::where('id',$data['cartid'])->delete();
        $getCartItems =Cart::getCartItems();
        $totalCartItems=totalCartItems();
        return response()->json([
         'totalCartItems'=>$totalCartItems,
         'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems'))
     ]);
       }
    }
}
