<?php

namespace App\Models;

use App\Models\OrdersProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdersLog extends Model
{
    use HasFactory;
    public function orders_products(){
        return $this->hasMany('App\Models\OrdersProduct','id','order_item_id');
    }
    public static function getItemDetails($order_item_id){
       $getItemDetails=OrdersProduct::where('id',$order_item_id)->first()->toArray();
       return $getItemDetails;
    }
}
