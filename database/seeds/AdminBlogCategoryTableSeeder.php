<?php

use Illuminate\Database\Seeder;

class AdminBlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->delete();
        $blogCategoryRecords = [
            [
                'id' => '2859a64b-fb76-4771-a6cd-b4e92cbde5d1',
                'parent_id' =>0,
                'cat_name' =>'Lorem Ipsum',
                'description' =>'Lorem Ipsum',
                'url' => 'lorem-ipsum',
                'meta_title' =>'Lorem Ipsum',
                'meta_description' =>'Lorem Ipsum',
                'meta_keywords' =>'Lorem Ipsum',
                'status'=>1,
            ],
        ];
        DB::table('blog_categories')->insert($blogCategoryRecords);
    }
}
