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
            ['id'=>'371d9e21-b3d3-4913-9e2a-2310e0223a64','name'=>'Polo','status'=>1],
            ['id'=>'371d0e21-b3d3-4913-9e2a-2310e0223a67','name'=>'Nike','status'=>1],
            ['id'=>'711d9e21-b3d3-4913-9e2a-2310e0223a67','name'=>'Jack','status'=>1],
            ['id'=>'371d9e21-b3d3-4913-9e2a-2010e0223a67','name'=>'Ankara','status'=>1],
            ['id'=>'371d9e21-b3d5-4913-9e2a-2310e0223a67','name'=>'Gucci','status'=>1],
        ];
        foreach ($brandRecords as $key => $record){
            Brand::create($record);
        }
    }
}
