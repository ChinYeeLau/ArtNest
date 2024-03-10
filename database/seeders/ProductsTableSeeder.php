<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords=[
            ['id'=>1,'section_id'=>1,'category_id'=>1,'vendor_id'=>1,'admin_id'=>'2','admin_type'=>'vendor','product_name'=>'digital print','product_code'=>'A1','product_color'=>'White','product_price'=>50,'product_discount'=>10,'product_weight'=>500,'product_image'=>'','meta_title'=>'','description'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1],
            ['id'=>2,'section_id'=>3,'category_id'=>5,'vendor_id'=>0,'admin_id'=>'1','admin_type'=>'superadmin','product_name'=>'Illus T-shirt','product_code'=>'C1','product_color'=>'Red','product_price'=>50,'product_discount'=>20,'product_weight'=>200,'product_image'=>'','description'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1]

        ];
        Product::insert($productRecords);
    }
}
