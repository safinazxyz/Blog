<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       $this->call(AdminsTableSeeder::class);
//        factory(App\BlogPost::class,10)->create();
//        factory(App\BlogCategory::class,10)->create();
//        factory(App\User::class,10)->create();
        $this->call(AdminBlogCategoryTableSeeder::class);
    }
}
