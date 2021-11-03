<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weights')->insert([
            [
                'id' => 1,
                'date_time' => '2021-09-03 13:17:39',
                'weight' => 2400,
                'pets_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'date_time' => '2021-09-14 13:17:39',
                'weight' => 2500,
                'pets_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'date_time' => '2021-09-28 13:17:39',
                'weight' => 2330,
                'pets_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'date_time' => '2021-09-28 18:17:39',
                'weight' => 2320,
                'pets_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'date_time' => '2021-09-17 13:17:39',
                'weight' => 730,
                'pets_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'date_time' => '2021-10-14 13:17:39',
                'weight' => 820,
                'pets_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'date_time' => '2021-10-28 13:17:39',
                'weight' => 800,
                'pets_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
