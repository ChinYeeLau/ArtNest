<?php

namespace App\Models;

use Session;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    public static function getCartitems(){
        if(Auth::check()){
           //if user logged in/pick auth id of the user
           $getCartItems = Cart::with(['product' => function ($query) {
            $query->select('id', 'category_id', 'product_name', 'product_code', 'product_color', 'product_image','product_weight');
        }])->orderby('id','Desc')->where('user_id',Auth::user()->id)->get()->toArray();
        }else{
          //if user not logged in /pick session id 
          $getCartItems = Cart::with(['product' => function ($query) {
            $query->select('id', 'category_id', 'product_name', 'product_code', 'product_color', 'product_image','product_weight');
        }])->orderby('id','Desc')->where('session_id',Session::get('session_id'))->get()->toArray();

        }
        return $getCartItems;
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
