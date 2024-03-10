<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\ProductsAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use App\Models\Banner;

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
    
    public function detail($id){
      $productDetails=Product::with(['category','attributes'=>function($query){$query->where('stock','>',0)->where('status',1);},'images'])->find ($id)->toArray();
      $categoryDetails=Category::categoryDetails($productDetails['category']['url']);
      // dd( $categoryDetails);
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
}
