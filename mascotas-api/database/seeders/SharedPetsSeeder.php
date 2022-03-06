<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SharedPetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shared_pets')->insert([
            [
                'id' => 1,
                'accepted' => 1,
                'description' => "Hola, ¿qué tal? Acá te comparto el perfil de Sisi, como ya te comenté por whatsapp tiene una infección en la oreja desde hace 3 días. Espero que me puedas ayudar. Desde ya muchas gracias :)",
                'expiration_date' => '2022/03/20',
                'pets_id' => 1,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 2,
                'accepted' => 1,
                'description' => "Buenos días! Esta mascota la rescaté hace un par de semanas de la calle. Seguramente necesita un chequeo general y aplicación de las vacunas.",
                'expiration_date' => '2022/04/15',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 3,
                'accepted' => 1,
                'description' => "Acá te comparto Lucio...Avisame para coordinar una consulta.",
                'expiration_date' => '2022/03/23',
                'pets_id' => 3,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 4,
                'accepted' => 1,
                'description' => "Hola doctor, espero que se encuentre bien. Necesito un tratamiento especial para esta gatita por favor.",
                'expiration_date' => '2022/04/30',
                'pets_id' => 1,
                'owners_id' => 1,
                'professionals_id' => 3,
            ],
            [
                'id' => 5,
                'accepted' => 1,
                'description' => null,
                'expiration_date' => '2022/05/02',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 4,
            ],
            [
                'id' => 6,
                'accepted' => 0,
                'description' => 'no aceptado',
                'expiration_date' => '2022/05/22',
                'pets_id' => 3,
                'owners_id' => 1,
                'professionals_id' => 3,
            ],
            [
                'id' => 7,
                'accepted' => 0,
                'description' => 'no aceptado',
                'expiration_date' => '2022/05/22',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 8,
                'accepted' => 0,
                'description' => 'expirado',
                'expiration_date' => '2021/11/22',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 9,
                'accepted' => 1,
                'description' => 'expirado',
                'expiration_date' => '2022/01/22',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 10,
                'accepted' => 1,
                'description' => 'expirado',
                'expiration_date' => '2022/01/14',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 11,
                'accepted' => 1,
                'description' => 'Hola doctor! Espero mucho que me puedas ayudar con el problema de respiración de Enigma. Muchas gracias!',
                'expiration_date' => '2022/04/14',
                'pets_id' => 6,
                'owners_id' => 17,
                'professionals_id' => 2,
            ],
            [
                'id' => 12,
                'accepted' => 1,
                'description' => null,
                'expiration_date' => '2022/05/01',
                'pets_id' => 7,
                'owners_id' => 17,
                'professionals_id' => 2,
            ],
            [
                'id' => 13,
                'accepted' => 1,
                'description' => 'Esto es mi hamster Luke.',
                'expiration_date' => '2022/03/27',
                'pets_id' => 9,
                'owners_id' => 18,
                'professionals_id' => 2,
            ],
        ]);
    }
}
