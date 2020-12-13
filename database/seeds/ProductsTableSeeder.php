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
                'id'=>'371d0e21-b3d3-4912-9e2a-2310e0223c23',
                'category_id'=>'371d9e21-b3d3-4913-9e2a-2310e0223a67',
                'section_id'=>'137d9e21-b3d3-4913-9e2a-2310e0223a67',
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
                'brand_id'=>'371d0e21-b3d3-4913-9e2a-2310e0223a67',
                'is_featured'=>'No',
                'status'=>1
            ],
            [
                'id'=>'371d0e21-b3d3-4913-9e2a-2310e0223c23',
                'category_id'=>'371d9e21-b3d3-4913-9e2a-2310e0223a67',
                'section_id'=>'137d9e21-b3d3-4913-9e2a-2310e0223a67',
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
                'brand_id'=>'371d0e21-b3d3-4913-9e2a-2310e0223a67',
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
