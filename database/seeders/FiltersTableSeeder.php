<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsFilter;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterRecords = [
           ['id'=>1,'cat_ids'=>'1,2,4,5,6,7,9,10','filter_name'=>'Color','filter_column'=>'color','status'=>1]
        ];
        ProductsFilter::insert($filterRecords);
}
}
