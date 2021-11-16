<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            [
                'id' => 1,
                'name' => 'Amoxicilina',
                'quantity' => '20mg',
                'start_date' => '2021/11/15',
                'end_date' => '2021/11/16',
                'pets_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Aspirina',
                'quantity' => '1/2 pastilla',
                'start_date' => '2021/11/14',
                'end_date' => '2021/11/14',
                'pets_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Paracetamol',
                'quantity' => '1/5 pastilla',
                'start_date' => '2021/11/20',
                'end_date' => '2021/11/24',
                'pets_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('medicines_has_hours')->insert([
            [
                'id' => 1,
                'medicines_id' => 1,
                'hours_id' => 33, //08:00
            ],
            [
                'id' => 2,
                'medicines_id' => 1,
                'hours_id' => 81, //20:00
            ],
            [
                'id' => 3,
                'medicines_id' => 2,
                'hours_id' => 41, // 10:00
            ],
            [
                'id' => 4,
                'medicines_id' => 2,
                'hours_id' => 80, // 22:00
            ],
            [
                'id' => 5,
                'medicines_id' => 3,
                'hours_id' => 33, // 08:00
            ],
            [
                'id' => 6,
                'medicines_id' => 3,
                'hours_id' => 49, // 12:00
            ],
            [
                'id' => 7,
                'medicines_id' => 3,
                'hours_id' => 65, // 16:00
            ],
            [
                'id' => 8,
                'medicines_id' => 3,
                'hours_id' => 81, // 16:00
            ],
        ]);
    }
}
