<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'id' => 1,
            'name' => 'Platformen',
            'code' => 'GM 1',
            'description' => 'The basics of IT technology',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'id' => 2,
            'name' => 'Performance Marketing',
            'code' => 'GM 2',
            'description' => 'Marketing aspects of IT technology',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'id' => 3,
            'name' => 'Content Marketing',
            'code' => 'SM 3',
            'description' => 'Mastering of content marketing',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'id' => 4,
            'name' => 'Technologies',
            'code' => 'SM 4',
            'description' => 'Main techs of IT industry',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'id' => 5,
            'name' => 'Strategies',
            'code' => 'MM 5',
            'description' => 'Strategies of successful projects',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'id' => 6,
            'name' => 'Leadership',
            'code' => 'MM 6',
            'description' => 'The basics of Leadership',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
