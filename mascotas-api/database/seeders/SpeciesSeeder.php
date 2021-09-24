<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('species')->insert([
            [
                'id' => 1,
                'name' => 'Perro',
            ],
            [
                'id' => 2,
                'name' => 'Gato',
            ],
            [
                'id' => 3,
                'name' => 'Conejo',
            ],
            [
                'id' => 4,
                'name' => 'Hámster',
            ],
            [
                'id' => 5,
                'name' => 'Tortuga',
            ],
            [
                'id' => 6,
                'name' => 'Hurón',
            ],
            [
                'id' => 7,
                'name' => 'Chinchilla',
            ],
            [
                'id' => 8,
                'name' => 'Lagarto',
            ],
            [
                'id' => 9,
                'name' => 'Pájaro',
            ],
            [
                'id' => 10,
                'name' => 'Cerdo miniatura',
            ],
            [
                'id' => 11,
                'name' => 'Pez',
            ],
            [
                'id' => 12,
                'name' => 'Otro',
            ],
        ]);
    }
}
