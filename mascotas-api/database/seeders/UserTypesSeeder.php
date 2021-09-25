<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            [
                'id' => 1,
                'name' => 'Super administrador',
            ],
            [
                'id' => 2,
                'name' => 'Administrador',
            ],
            [
                'id' => 3,
                'name' => 'Controlador',
            ],
            [
                'id' => 4,
                'name' => 'Dueño de mascota',
            ],
            [
                'id' => 5,
                'name' => 'Veterinario en local',
            ],
            [
                'id' => 6,
                'name' => 'Veterinario a domicilio',
            ],
            [
                'id' => 7,
                'name' => 'Paseador de perro',
            ],
            [
                'id' => 8,
                'name' => 'Tienda de mascotas',
            ],
        ]);
    }
}
