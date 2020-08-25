<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'name' => 'max_amount_of_module_days',
            'value' => '8',
            'description' => 'This amount will be used for each module days number',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('settings')->insert([
            'id' => 2,
            'name' => 'max_amount_of_lecture_slots',
            'value' => '8',
            'description' => 'Maximum amount of lecture slots in module day',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('settings')->insert([
            'id' => 3,
            'name' => 'max_amount_of_lectures_in_slot',
            'value' => '3',
            'description' => 'Maximum amount of lectures in slots',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
