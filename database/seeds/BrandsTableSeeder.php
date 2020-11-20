<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            ['id'=>1,'name'=>'Polo','status'=>1],
            ['id'=>2,'name'=>'Nike','status'=>1],
            ['id'=>3,'name'=>'Jack','status'=>1],
            ['id'=>4,'name'=>'Ankara','status'=>1],
            ['id'=>5,'name'=>'Gucci','status'=>1],
        ];
        foreach ($brandRecords as $key => $record){
            Brand::create($record);
        }
    }
}
