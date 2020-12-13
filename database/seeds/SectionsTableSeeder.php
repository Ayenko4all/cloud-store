<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords = [
            ['id'=>'137d9e21-b3d3-4913-9e2a-2310e0223a67','name'=>'Men','status'=>1],
            ['id'=>'232d9e21-b3d3-4913-9e2a-2310e0223a61','name'=>'Women','status'=>1],
            ['id'=>'837d9e21-b3d3-4913-9e2a-2310e0223a61','name'=>'Kids','status'=>1],
        ];
        foreach ($sectionsRecords as $key => $record){
            Section::create($record);
        }
    }
}
