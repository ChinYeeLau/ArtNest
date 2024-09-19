<?php

namespace App\Models;

use App\Models\VendorsBusinessDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state',
        'mobile',
        'current_status',
        'portfolio',
        'status'
        // Add more attributes as needed
    ];
    public function vendorbusinessdetails(){
        return $this->belongsTo('App\Models\VendorsBusinessDetail','id','vendor_id');
    }

    public static function getVendorShop($vendorid){
        $getVendorShop=VendorsBusinessDetail::select('shop_name')->where('vendor_id',$vendorid)->first()->toArray();
        return $getVendorShop['shop_name'];
    }

  

}