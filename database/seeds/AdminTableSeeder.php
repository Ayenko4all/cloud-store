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
               'id' => 1,
               'name' => 'admin',
               'type' => 'admin',
               'mobile' => '09030448824',
               'email' => 'admin@gmail.com',
               'password' => Hash::make('password'),
               'image' => '',
               'status' =>1
           ],
            [
                'id' => 2,
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
