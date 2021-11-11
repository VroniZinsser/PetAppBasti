<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pets')->insert([
            [
                'id' => 1,
                'name' => 'Sisi',
                'breed' => null,
                'temperament' => 'Mimosa, le gusta hacer renegar al dueño',
                'neutered' => 1,
                'date_of_birth' => now(),
                'images_id' => 1,
                'sexes_id' => 1,
                'species_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Ishi',
                'breed' => null,
                'temperament' => null,
                'neutered' => null,
                'date_of_birth' => null,
                'images_id' => 2,
                'sexes_id' => 1,
                'species_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Dadi',
                'breed' => 'American bully',
                'temperament' => null,
                'neutered' => null,
                'date_of_birth' => null,
                'images_id' => 3,
                'sexes_id' => 2,
                'species_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 4,
                'name' => 'Jerónimo',
                'breed' => null,
                'temperament' => null,
                'neutered' => null,
                'date_of_birth' => null,
                'images_id' => 4,
                'sexes_id' => 2,
                'species_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 5,
                'name' => 'Joy',
                'breed' => null,
                'temperament' => null,
                'neutered' => null,
                'date_of_birth' => null,
                'images_id' => 3,
                'sexes_id' => 1,
                'species_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
