<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('admins')->delete();
        $adminRecords = [
           [
               'id' => '201d0e21-b3d3-0612-9e2a-2310e0343c23',
               'name' => 'admin',
               'type' => 'admin',
               'mobile' => '09030448824',
               'email' => 'admin@gmail.com',
               'password' => Hash::make('password'),
               'image' => '',
               'status' =>1
           ],
            [
                'id' => '401d0e01-b3d3-4912-9e2a-0010e0343c23',
                'name' => 'adminjohn',
                'type' => 'subadmin',
                'mobile' => '09075021402',
                'email' => 'adminjohn@gmail.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status' =>1
            ]
        ];
        foreach ($adminRecords as $key => $record){
            Admin::create($record);
        }
    }
}
