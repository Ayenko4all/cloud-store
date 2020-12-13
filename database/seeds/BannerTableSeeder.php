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
            ['id'=>'371d9e21-s3d3-4912-9e2a-2310e0223c23','image'=>'banner-1.png','link'=>'','title'=>'Back Jacket','alt'=>'Back Jacket','status'=>1],
            ['id'=>'401d0e21-b3d3-4912-9e2a-2310e0343c23','image'=>'banner-2.png','link'=>'','title'=>'Blue Tshirt','alt'=>'Blue Tshirt','status'=>1],
            ['id'=>'581d0e21-b3d3-4912-9e2a-2310e0983c23','image'=>'banner-3.png','link'=>'','title'=>'Black Tshirt','alt'=>'Black Tshirt','status'=>1]
        ];

        foreach ($bannersRecord as $record){
            Banner::create($record);
        }
    }
}
