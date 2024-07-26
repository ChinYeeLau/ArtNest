<?php

use App\Models\CmsPage;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Front\PusherController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\CouponsController;
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
       Route::get('view-vendor-details/{id}',[AdminController::class, 'viewVendorDetails'])->name('viewVendorDetails');
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
       //Coupons
        Route::get('coupons','CouponsController@coupons');
        Route::post('update-coupon-status','CouponsController@updateCouponStatus');
        Route::get('delete-coupon/{id}','CouponsController@deleteCoupon');
        Route::match(['get','post'],'add-edit-coupon/{id?}','CouponsController@addEditCoupon');
        //Users
        Route::get('users','UserController@users');
        Route::post('update-user-status','UserController@updateUserStatus');
        //CMS Pages
         Route::get('cms-pages','CmsController@cmspages');
         Route::post('update-cms-page-status','CmsController@updatePageStatus');
         Route::get('delete-page/{id}','CmsController@deletePage');
         Route::match(['get','post'],'add-edit-cms-page/{id?}','CmsController@addEditCmsPage');

         //Orders
         Route::get('orders','OrderController@orders');
         Route::get('orders/{id}','OrderController@orderDetails');
         Route::post('update-order-status','OrderController@updateOrderStatus');
         Route::post('update-order-item-status','OrderController@updateOrderItemStatus');
         //order invoices
         Route::get('orders/invoice/{id}','OrderController@viewOrderInvoice');
         Route::get('orders/invoice/pdf/{id}','OrderController@viewPDFInvoice');
        //shipping charges
        Route::get('shipping-charges','ShippingController@shippingCharges');
        Route::post('update-shipping-status','ShippingController@updateShippingStatus');
        Route::match(['get','post'],'edit-shipping-charges/{id}','ShippingController@editShippingCharges');
        // newsletter subscriber
        Route::get('subscribers','NewsletterController@subscribers');
        Route::post('update-subscriber-status','NewsletterController@updateSubscriberStatus');
        Route::get('delete-subscriber/{id}','NewsletterController@deleteSubscriber');
        //ratings
        Route::get('ratings','RatingController@ratings');
        Route::post('update-rating-status','RatingController@updateRatingStatus');
        Route::get('delete-rating/{id}','RatingController@deleteRating');
    });
        
});
Route::get('orders/invoice/download/{id}','App\Http\Controllers\Admin\OrderController@viewPDFInvoice');

Route::namespace('App\Http\Controllers\Front')->group(function(){
     Route::get('/',[IndexController::class, 'index']);
     //listing categories routes
 $catUrls=Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
 //dd($catUrls);
 foreach($catUrls as $key=>$url){
    Route::match(['get','post'],'/'.$url,'ProductsController@listing');
 }
 //CMS Pages routes
$cmsUrls=CmsPage::select('url')->where('status',1)->get()->pluck('url')->toArray();
foreach($cmsUrls as $url){
    Route::get($url,'CmsController@cmsPage');
}
 //vendor products
 Route::get('/products/{vendorid}','ProductsController@vendorListing');
 //product detail page
 Route::get('/product/{id}','ProductsController@detail');
 //get product attribute price
 Route::post('get-product-price','ProductsController@getProductPrice');
 //vendor login/Register
 Route::get('vendor/login','VendorController@login');
  //vendor login/Register
  Route::get('vendor/register','VendorController@register');
 //vendor register
 Route::post( 'vendor/register', 'VendorController@vendorRegister');
 //confirm vendor acc
 Route::get('vendor/confirm/{code}', 'VendorController@confirmVendor')->name('vendor.confirm');
  //vendor forgot password
  Route::match(['get','post'],'vendor/forgot-password','VendorController@vendorForgotPassword');
//add to cart 
Route::post('cart/add','ProductsController@cartAdd');
//cart route
Route::get('cart','ProductsController@cart');
//update cart item qty
Route::post('cart/update','ProductsController@cartUpdate');
//delete cart item
Route::post('cart/delete','ProductsController@cartDelete');
 //user login
 Route::get('user/login', ['as' => 'login', 'uses' => 'UserController@login']);
 //user Register
  Route::get('user/register','UserController@register');
 //user register
 Route::post('user/register','UserController@userRegister');
//search products
Route::get('search-products','ProductsController@listing');
//contct page
Route::match(['GET','POST'],'contact','CMSController@contact');
// add subscriber email
Route::post('add-subscriber-email','NewsletterController@addSubscriber');
//add to wishlist 
Route::post('wishlist/add-remove','ProductsController@wishlistAddRemove');
//wishlist route
Route::get('wishlist','ProductsController@wishlist');
//delete wishlist item through wishlist_items
Route::post('wishlist/delete','ProductsController@wishlistDelete');
//add rating review
Route::post('add-rating','RatingController@addRating');



Route::group(['middleware'=>['auth']],function(){

 //user account
 Route::match(['get','post'],'user/account','UserController@userAccount');
 //user update password
 Route::post('user/update-password','UserController@userUpdatePassword');
 //apply coupon
 Route::post('/apply-coupon','ProductsController@applyCoupon');
 //Checkout
 Route::match(['get','post'],'/checkout','ProductsController@checkout');
 //get delivery address
 Route::post('get-delivery-address','AddressController@getDeliveryAddress');
 //save delivery address
 Route::post('save-delivery-address','AddressController@saveDeliveryAddress');
 //remove delivery address
 Route::post('remove-delivery-address','AddressController@removeDeliveryAddress');
 //thanks 
 Route::get('thanks','ProductsController@thanks');
 //users orders
 Route::get('user/orders/{id?}','OrderController@orders');
//paypal
Route::get('paypal','PaypalController@paypal');
Route::post('paypal/pay','PaypalController@pay')->name('paypal.pay');
Route::get('paypal/success','PaypalController@success')->name('paypal.success');
Route::get('paypal/error','PaypalController@error');
//stripe route
Route::get('stripe','StripeController@stripe');
Route::post('stripe/pay','StripeController@stripePay')->name('stripe.pay');
Route::get('stripe/success','StripeController@success')->name('payment.success');
Route::get('paypal/error','StripeController@error')->name('payment.error');
//chat
Route::get('/chats', [ChatController::class, 'index'])->name('chats.chat');
Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
Route::put('/chats/{chat}/messages', [MessageController::class, 'store'])->name('messages.store');
Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

});

 //user login
 Route::post('user/login','UserController@userLogin');
 //user forgot password
 Route::match(['get','post'],'user/forgot-password','UserController@forgotPassword');
 //user logout
 Route::get('user/logout','UserController@userLogout');
 //confirm user account
 Route::get('user/confirm/{code}','UserController@confirmAccount');
});

