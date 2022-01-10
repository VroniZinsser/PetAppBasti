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
                'professionals_id' => null,
            ],
            [
                'id' => 2,
                'accepted' => 1,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
                'expiration_date' => '2022/01/21',
                'pets_id' => 2,
                'owners_id' => 1,
                'professionals_id' => 2,
            ],
            [
                'id' => 3,
                'accepted' => 0,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
                'expiration_date' => '2022/01/22',
                'pets_id' => 5,
                'owners_id' => 2,
                'professionals_id' => null,
            ],
        ]);
    }
}
