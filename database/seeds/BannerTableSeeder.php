<?php

use App\Banner;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannersRecord = [
            ['id'=>1,'image'=>'banner-1.png','link'=>'','title'=>'Back Jacket','alt'=>'Back Jacket','status'=>1],
            ['id'=>2,'image'=>'banner-2.png','link'=>'','title'=>'Blue Tshirt','alt'=>'Blue Tshirt','status'=>1],
            ['id'=>3,'image'=>'banner-3.png','link'=>'','title'=>'Black Tshirt','alt'=>'Black Tshirt','status'=>1]
        ];

        foreach ($bannersRecord as $record){
            Banner::create($record);
        }
    }
}
