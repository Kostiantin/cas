<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'id' => 1,
            'title' => 'Technology Management',
            'description' => 'Main points you should know to have success',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('courses')->insert([
            'id' => 2,
            'title' => 'Digital Marketing and Vertrieb',
            'description' => 'Find out more about d.marketing and vertrieb',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('courses')->insert([
            'id' => 3,
            'title' => 'Business Management and Leadership',
            'description' => 'Very important steps to become a master in bm and l',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
