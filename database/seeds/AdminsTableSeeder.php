<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => 'baf8f2c6-436f-4cc2-b8eb-e09d3d6c0e03',
                'name' => 'admin',
                'type' => 'admin',
                'mobile' => '9800000000',
                'email' => 'adminSultan@admin.com',
                'password' => '$2y$10$g3bxDmt/1/b9Ql4/OhYyAeAXC7kSpN6Z7z2aLCwpRb5mg919OvyJa',
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 'df0495b5-18c5-4361-877b-98c0622da7f3',
                'name' => 'admin2',
                'type' => 'subadmin',
                'mobile' => '9800000000',
                'email' => 'admin2@admin.com',
                'password' => '$2y$10$g3bxDmt/1/b9Ql4/OhYyAeAXC7kSpN6Z7z2aLCwpRb5mg919OvyJa',
                'image' => '',
                'status' => 1
            ],
            [
                'id' => '4651bb5c-b8bd-4b04-a059-307784ec33a2',
                'name' => 'admin3',
                'type' => 'subadmin',
                'mobile' => '9800000000',
                'email' => 'admin3@admin.com',
                'password' => '$2y$10$g3bxDmt/1/b9Ql4/OhYyAeAXC7kSpN6Z7z2aLCwpRb5mg919OvyJa',
                'image' => '',
                'status' => 1
            ],
        ];
        DB::table('admins')->insert($adminRecords);
       /* foreach ($adminRecords as $key=>$record) {
            \App\Admin::create($record);
        }*/
    }
}
