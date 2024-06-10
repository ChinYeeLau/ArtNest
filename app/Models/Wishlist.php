<?php

namespace App\Models;

use Auth;
use Session;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    public static function getWishlistitems(){
        if(Auth::check()){
           //if user logged in/pick auth id of the user
           $getWishlistItems = Wishlist::with(['product' => function ($query) {
            $query->select('id', 'category_id', 'product_name', 'product_code', 'product_image');
        }])->orderby('id','Desc')->where('user_id',Auth::user()->id)->get()->toArray();
        }else{
          //if user not logged in /pick session id 
          $getWishlistItems = Wishlist::with(['product' => function ($query) {
            $query->select('id', 'category_id', 'product_name', 'product_code','product_image');
        }])->orderby('id','Desc')->where('session_id',Session::get('session_id'))->get()->toArray();

        }
        return $getWishlistItems;
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public static function isInWishlist($productId)
    {
        // Implement your logic here to check if the product is in the wishlist
        // You may need to query your database or use any other method to determine this
        // For example, assuming you have a 'wishlist_items' table containing user_id and product_id fields:
        $userId = auth()->id(); // Assuming you're using authentication
        $isInWishlist::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->exists();
                    return  $isInWishlist;
    }
}


