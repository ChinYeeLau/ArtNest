<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords=[
            ['id'=>1,'vendor_id'=>1,'account_holder_name'=>'Lau haha','bank_name'=>'CIMB','account_number'=>'1234567890'],
        ];
        VendorsBankDetail::insert($vendorRecords);
    }
}