<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state',
        'mobile',
        'current_status',
        'portfolio',
        // Add more attributes as needed
    ];

    public function vendorbusinessdetails(){
        return $this->belongsTo('App\Models\VendorsBusinessDetail','id','vendor_id');
    }
   
    public static function getVendorShop($vendorid){
        $vendorBusinessDetail = VendorsBusinessDetail::select('shop_name')->where('vendor_id', $vendorid)->first();
        if ($vendorBusinessDetail) {
            return $vendorBusinessDetail->shop_name;
        } else {
            return null; // or handle the case when vendor shop is not found
        }
      
    }
}