<?php

use Illuminate\Database\Seeder;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lectures')->insert([
            'id' => 1,
            'name' => 'Newsletters marketing',
            'duration' => 45,
            'description' => 'All main points about newsletters marketing',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('lectures')->insert([
            'id' => 2,
            'name' => 'SEO',
            'duration' => 45,
            'description' => 'Extensive information about how to do important parts of SEO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('lectures')->insert([
            'id' => 3,
            'name' => 'Meta tags',
            'duration' => 15,
            'description' => 'Meta tags in web development',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('lectures')->insert([
            'id' => 4,
            'name' => 'Google Ads Marketing',
            'duration' => 30,
            'description' => 'One of the most important skills for marketer - Google Ads mastering',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
