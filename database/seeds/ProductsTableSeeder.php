<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'id'=>1,
                'category_id'=>2,
                'section_id'=>1,
                'product_name'=>'Blue T-Shirt',
                'product_code'=>'BT001',
                'product_color'=>'Blue',
                'product_price'=>'1500',
                'product_discount'=>10,
                'product_weight'=>200,
                'product_video'=>'',
                'main_image'=>'',
                'description'=>'',
                'wash_care'=>'',
                'fabric'=>'',
                'pattern'=>'',
                'sleeve'=>'',
                'fit'=>'',
                'occasion'=>'',
                'meta_title'=>'',
                'meta_description'=>'',
                'is_featured'=>'No',
                'status'=>1
            ],
            [
                'id'=>2,
                'category_id'=>7,
                'section_id'=>2,
                'product_name'=>'Brown shoe',
                'product_code'=>'BH001',
                'product_color'=>'Brown',
                'product_price'=>'1000',
                'product_discount'=>10,
                'product_weight'=>100,
                'product_video'=>'',
                'main_image'=>'',
                'description'=>'',
                'wash_care'=>'',
                'fabric'=>'',
                'pattern'=>'',
                'sleeve'=>'',
                'fit'=>'',
                'occasion'=>'',
                'meta_title'=>'',
                'meta_description'=>'',
                'is_featured'=>'Yes',
                'status'=>1
            ]
        ];
        foreach ($productRecords as $key => $record){
            Product::create($record);
        }
        //Product::insert($productRecords );
    }
}
