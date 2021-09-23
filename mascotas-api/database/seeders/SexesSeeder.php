<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SexesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
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
