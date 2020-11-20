<?php

use App\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ProductsAttributesRecords = [
            ['id'=>1, 'product_id'=>1, 'size'=>'large', 'stock'=>10, 'price'=>1500, 'sku'=>'BT001-L', 'status'=>1],
            ['id'=>2, 'product_id'=>1, 'size'=>'medium', 'stock'=>5, 'price'=>2400, 'sku'=>'BT001-M', 'status'=>1],
            ['id'=>3, 'product_id'=>1, 'size'=>'small', 'stock'=>15, 'price'=>2000, 'sku'=>'BT001-S', 'status'=>1]
        ];
        foreach ($ProductsAttributesRecords as $key => $record){
            ProductAttribute::create($record);
        }
    }
}
