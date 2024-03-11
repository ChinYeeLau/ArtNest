<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard',[AdminController::class,'dashboard']);
        //Admin Password
        Route::match(['get','post'],'update-admin-password', [AdminController::class, 'updateAdminPassword']);
         // Check Admin Password
         Route::post('check-admin-password', [AdminController::class, 'checkAdminPassword']);
        //Admin Details
        Route::match(['get','post'],'update-admin-details', [AdminController::class, 'updateAdminDetails']);
       //Update Vendor detail
       Route::match(['get','post'],'update-vendor-details/{slug}', [AdminController::class, 'updateVendorDetails']);
       //View Admins Vendors
       Route::get('admins/{type?}', [AdminController::class, 'admins']);
       //view vendor detail
       Route::get('view-vendor-details/{id}',[AdminController::class, 'viewVendorDetails']);
       //update admin status
       Route::post('update-admin-status',[AdminController::class, 'updateAdminStatus']);
       //Admin Logout
        Route::get('logout', [AdminController::class, 'logout']);
        //Sections
        Route::get('sections',[SectionController::class, 'sections']);
        Route::post('update-section-status',[SectionController::class, 'updateSectionStatus']);
       Route::get('delete-section/{id}',[SectionController::class, 'deleteSection']);
       Route::match(['get','post'],'add-edit-section/{id?}',[SectionController::class, 'addEditSection']);
        //category
        Route::get('categories',[CategoryController::class, 'categories']);
        Route::post('update-category-status',[CategoryController::class, 'updateCategoryStatus']);
        Route::match(['get','post'],'add-edit-category/{id?}',[CategoryController::class, 'addEditCategory']);
        Route::get('delete-category/{id}',[CategoryController::class, 'deleteCategory']);
        Route::get('delete-category-image/{id}',[CategoryController::class, 'deleteCategoryImage']);
       //product
       Route::get('products',[ProductsController::class, 'products']);
       Route::post('update-product-status',[ProductsController::class, 'updateProductStatus']);
        Route::get('delete-product/{id}',[ProductsController::class, 'deleteProduct']);
        Route::match(['get','post'],'add-edit-product/{id?}',[ProductsController::class, 'addEditProduct']);
        Route::get('delete-product-image/{id}',[ProductsController::class, 'deleteProductImage']);
        // Attributes
        Route::match(['get','post'],'add-edit-attributes/{id}',[ProductsController::class, 'addAttributes']);
        Route::post('update-attribute-status',[ProductsController::class, 'updateAttributeStatus']);
         Route::get('delete-attribute/{id}',[ProductsController::class, 'deleteAttribute']);
         Route::match(['get','post'],'edit-attributes/{id}',[ProductsController::class, 'editAttributes']);
        //Filters
        Route::get('filters',[FilterController::class,'filters']);
        Route::get('filters-values',[FilterController::class,'filtersValues']);
        Route::post('update-filter-status',[FilterController::class, 'updateFilterStatus']);
        Route::post('update-filter-value-status',[FilterController::class, 'updateFilterValueStatus']);
        Route::match(['get','post'],'add-edit-filter/{id?}',[FilterController::class,'addEditFilter']);
        Route::match(['get','post'],'add-edit-filter-value/{id?}',[FilterController::class,'addEditFilterValue']);
        Route::post('category-filters',[FilterController::class,'categoryFilters']);
         //images
       Route::match(['get','post'],'add-images/{id}',[ProductsController::class, 'addImages']);
       Route::post('update-image-status',[ProductsController::class, 'updateImageStatus']);
       Route::get('delete-image/{id}',[ProductsController::class, 'deleteImage']);
       //Banners
       Route::get('banners',[BannersController::class,'banners']);
       Route::post('update-banner-status',[BannersController::class, 'updateBannerStatus']);
       Route::get('delete-banner/{id}',[BannersController::class, 'deleteBanner']);
        Route::match(['get','post'],'add-edit-banner/{id?}',[BannersController::class,'addEditBanner']);
        });
        
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
     Route::get('/',[IndexController::class, 'index']);
     //listing categories routes
 $catUrls=Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
 //dd($catUrls);
 foreach($catUrls as $key=>$url){
    Route::match(['get','post'],'/'.$url,'ProductsController@listing');
 }
 //vendor products
 Route::get('/products/{vendorid}','ProductsController@vendorListing');
 //product detail page
 Route::get('/product/{id}','ProductsController@detail');
 //get product attribute price
 Route::post('get-product-price','ProductsController@getProductPrice');
 //vendor login/Register
 Route::get('vendor/login-register','VendorController@loginRegister');
 //vendor register
 Route::post( 'vendor/register', 'VendorController@vendorRegister');
 //confirm vendor acc
 Route::get('vendor/confirm/{code}', 'VendorController@confirmVendor')->name('vendor.confirm');
});

