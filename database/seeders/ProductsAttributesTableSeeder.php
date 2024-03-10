<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords=[
            ['id'=>1,'product_id'=>2,'size'=>'Small','price'=>100,'stock'=>10,'sku'=>'C1-S','status'=>1],
            ['id'=>2,'product_id'=>2,'size'=>'Medium','price'=>120,'stock'=>15,'sku'=>'C1-M','status'=>1],
            ['id'=>3,'product_id'=>2,'size'=>'Large','price'=>140,'stock'=>20,'sku'=>'C1-L','status'=>1]

        ];

        ProductsAttribute::insert( $productAttributesRecords);
    }
}
