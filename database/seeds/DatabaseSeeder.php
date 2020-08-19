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
         $this->call(AdminsTableSeeder::class);
         $this->call(ModulesTableSeeder::class);
         $this->call(CoursesTableSeeder::class);
         $this->call(CertificatesTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
    }
}
