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
                'expiration_date' => '2022/03/20',
                'pets_id' => 1,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 2,
                'accepted' => 0,
                'description' => "Hola, ¿qué tal? Acá te comparto el perfil de Sisi, como ya te comenté por whatsapp tiene una infección en la oreja desde hace 3 días. Espero que me puedas ayudar. Desde ya muchas gracias :)",
                'expiration_date' => '2022/03/21',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 3,
                'accepted' => 0,
                'description' => null,
                'expiration_date' => '2022/03/22',
                'pets_id' => 5,
                'owners_id' => 2,
                'professionals_id' => 2,
            ],
        ]);
    }
}
