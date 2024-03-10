<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsFiltersValue;

class FiltersValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filtervalueRecords=[
            ['id'=>1,'filter_id'=>1,'filter_value'=>'white','status'=>1],
            ['id'=>2,'filter_id'=>1,'filter_value'=>'black','status'=>1],
            ['id'=>3,'filter_id'=>1,'filter_value'=>'grey','status'=>1],
            ['id'=>4,'filter_id'=>1,'filter_value'=>'red','status'=>1],
            ['id'=>5,'filter_id'=>1,'filter_value'=>'orange','status'=>1],
            ['id'=>6,'filter_id'=>1,'filter_value'=>'yellow','status'=>1],
            ['id'=>7,'filter_id'=>1,'filter_value'=>'green','status'=>1],
            ['id'=>8,'filter_id'=>1,'filter_value'=>'blue','status'=>1],
            ['id'=>9,'filter_id'=>1,'filter_value'=>'margenta','status'=>1],
            ['id'=>10,'filter_id'=>1,'filter_value'=>'purple','status'=>1],
            ['id'=>11,'filter_id'=>1,'filter_value'=>'gold','status'=>1],
            ['id'=>12,'filter_id'=>1,'filter_value'=>'silver','status'=>1],
        ];
        ProductsFiltersValue::insert( $filtervalueRecords);
    }
}
