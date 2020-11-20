<?php

use App\ProductsImage;
use Illuminate\Database\Seeder;

class ProductsImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ProductsImageRecord = [
            ['id'=>1,'product_id'=>1,'image'=>'black tshirt.jpg-98239.jpg','status'=>1]
        ];

        foreach ($ProductsImageRecord as $key => $record){
            ProductsImage::create($record);
        }

    }
}
