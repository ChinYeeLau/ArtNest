<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecord=[
            ['id'=>1,'name'=>'Art','status'=>1],
            ['id'=>2,'name'=>'Photography','status'=>1],
            ['id'=>3,'name'=>'Tote Bag','status'=>1],
            ['id'=>4,'name'=>'Clothing','status'=>1],
            ['id'=>5,'name'=>'Ohers','status'=>1],
        ];
        Section::insert($sectionRecord);
    }
}
