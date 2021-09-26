<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'Cristian',
                'last_name' => 'Corbalan',
                'email' => 'ccris@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'address' => null,
                'dni' => null,
                'description' => null,
                'web' => null,
                'phone_number' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 2,
                'first_name' => 'Vero',
                'last_name' => 'Zinsser',
                'email' => 'veroz@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'address' => '711-2188 Ornare, Street',
                'dni' => 13942502,
                'description' => 'Una persona muy buena y amable c:',
                'web' => 'www.veroz.com',
                'phone_number' => '(914) 767-7735',
                'verified' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => 14,
                'credential_img_id' => 15,
            ],
            [
                'id' => 3,
                'first_name' => 'Zas',
                'last_name' => 'Ara',
                'email' => 'zasara@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'address' => '489 Risus. Rd.',
                'dni' => 41231512,
                'description' => 'Una persona que no valida y por eso es mala >:c',
                'web' => 'www.webfalsa.com',
                'phone_number' => '1-856-752-7418',
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => 14,
                'credential_img_id' => 16,
            ],
            [
                'id' => 4,
                'first_name' => 'Leonel',
                'last_name' => 'Roda',
                'email' => 'leito@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'address' => null,
                'dni' => null,
                'description' => null,
                'web' => null,
                'phone_number' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
        ]);

        DB::table('users_has_user_types')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'user_types_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'user_types_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'user_types_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'user_types_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'user_id' => 3,
                'user_types_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'user_id' => 4,
                'user_types_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('users_has_pets')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'pet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'pet_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_id' => 4,
                'pet_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}