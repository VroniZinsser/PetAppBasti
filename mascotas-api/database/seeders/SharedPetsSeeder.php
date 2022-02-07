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
                'accepted' => 0,
                'description' => null,
                'expiration_date' => '2022/01/20',
                'pets_id' => 1,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 2,
                'accepted' => 1,
                'description' => "Hola, ¿qué tal?",
                'expiration_date' => '2022/02/19',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 3,
                'accepted' => 1,
                'description' => "Hola, ¿qué tal? Acá te comparto el perfil de Sisi, como ya te comenté por whatsapp tiene una infección en la oreja desde hace 3 días. Espero que me puedas ayudar. Desde ya muchas gracias :)",
                'expiration_date' => '2022/02/23',
                'pets_id' => 3,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 4,
                'accepted' => 1,
                'description' => "Hola, ¿qué tal? Acá te comparto el perfil de Sisi, como ya te comenté por whatsapp tiene una infección en la oreja desde hace 3 días. Espero que me puedas ayudar. Desde ya muchas gracias :)",
                'expiration_date' => '2022/02/15',
                'pets_id' => 1,
                'owners_id' => 1,
                'professionals_id' => 3,
            ],
            [
                'id' => 5,
                'accepted' => 1,
                'description' => "Hola, ¿qué tal? Acá te comparto el perfil de Sisi, como ya te comenté por whatsapp tiene una infección en la oreja desde hace 3 días. Espero que me puedas ayudar. Desde ya muchas gracias :)",
                'expiration_date' => '2022/02/28',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 4,
            ],
            [
                'id' => 6,
                'accepted' => 0,
                'description' => null,
                'expiration_date' => '2022/01/22',
                'pets_id' => 5,
                'owners_id' => 2,
                'professionals_id' => null,
            ],
        ]);
    }
}
