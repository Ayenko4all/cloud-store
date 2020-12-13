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
            ['id'=>1,'product_id'=>'371d0e21-b3d3-4912-9e2a-2310e0223c23','image'=>'black tshirt.jpg-98239.jpg','status'=>1]
        ];

        foreach ($ProductsImageRecord as $key => $record){
            ProductsImage::create($record);
        }

    }
}
