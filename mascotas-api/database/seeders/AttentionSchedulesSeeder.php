<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttentionSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attention_schedules')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'day_of_week' => 1,
                'open_time' => '09:00',
                'close_time' => '18:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'day_of_week' => 2,
                'open_time' => '09:00',
                'close_time' => '18:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'day_of_week' => 3,
                'open_time' => '09:00',
                'close_time' => '13:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
