<?php

use Illuminate\Database\Seeder;

class CertificatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificates')->insert([
            'id' => 1,
            'title' => 'CAS Digital Marketing',
            'sub_title' => 'basics',
            'description' => 'Basics certificate',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('certificates')->insert([
            'id' => 2,
            'title' => 'DAS Specialized Manager',
            'sub_title' => 'speciality',
            'description' => 'Speciality certificate',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('certificates')->insert([
            'id' => 3,
            'title' => 'MAS Engineer',
            'sub_title' => 'mastering',
            'description' => 'Mastering certificate',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
