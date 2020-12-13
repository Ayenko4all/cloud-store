<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'id' => '371d9e21-b3d3-4913-9e2a-2310e0223a67',
                'parent_id' =>0,
                'section_id' =>'137d9e21-b3d3-4913-9e2a-2310e0223a67',
                'category_name'=>'T-Shirts',
                'image'=>'',
                'category_discount'=>0,
                'description'=>'',
                'url'=>'t-shirts',
                'meta_title' => '',
                'meta_description'=>'',
                'meta_keywords'=>'',
                'status'=>1
            ],
            [
                'id' =>'371d9a11-b3d3-4913-9e2a-2310e0223a67',
                'parent_id' =>'371d9e21-b3d3-4913-9e2a-2310e0223a67',
                'section_id' =>'137d9e21-b3d3-4913-9e2a-2310e0223a67',
                'category_name'=>'Casual-T-Shirts',
                'image'=>'',
                'category_discount'=>0,
                'description'=>'',
                'url'=>'casual-t-shirts',
                'meta_title' => '',
                'meta_description'=>'',
                'meta_keywords'=>'',
                'status'=>1
            ],
        ];
       foreach ($categoryRecords as $categoryRecord){
           Category::create($categoryRecord);
       }
    }
}
