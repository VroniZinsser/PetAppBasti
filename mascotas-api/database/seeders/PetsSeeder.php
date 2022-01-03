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
                'date_of_birth' => '2018-05-16',
                'images_id' => 17,
                'observation' => 'No le gusta para nada la comida de Royal Canin.',
                'sexes_id' => 1,
                'species_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Pompón',
                'breed' => null,
                'temperament' => null,
                'neutered' => 1,
                'date_of_birth' => '2018-05-16',
                'observation' => 'Se comió una torta de chocolate :-(',
                'images_id' =>18,
                'sexes_id' => 1,
                'species_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Lucio',
                'breed' => 'American bully',
                'temperament' => 'Un poco agresivo con desconocidos',
                'neutered' => 0,
                'date_of_birth' => null,
                'images_id' => 19,
                'observation' => null,
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
                'observation' => null,
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
                'observation' => null,
                'sexes_id' => 1,
                'species_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
