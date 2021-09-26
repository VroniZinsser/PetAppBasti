<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexes')->insert([
            [
                'id' => 1,
                'name' => 'hembra',
            ],
            [
                'id' => 2,
                'name' => 'macho',
            ],

        ]);
    }
}
