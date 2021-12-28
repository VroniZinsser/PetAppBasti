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
                'email' => 'cris@gmail.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'Argentina',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'city' => 'Ciudad de Buenos Aires',
                'district' => 'Almagro',
                'postal_code' => '1197',
                'street' => 'Sarmiento',
                'house_number' => '3995',
                'apartment' => '7E',
                'latitude' => -34.590095,
                'longitude' => -58.449511,
                'dni' => null,
                'public_name' => null,
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 2,
                'first_name' => 'Ana María',
                'last_name' => 'Lopez',
                'email' => 'veroz@gmail.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'Argentina',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'city' => 'Ciudad de Buenos Aires',
                'district' => 'Villa Crespo',
                'postal_code' => '1414',
                'street' => 'Padilla',
                'house_number' => '1008',
                'apartment' => '2B',
                'latitude' => -34.597090,
                'longitude' => -58.445850,
                'dni' => 13942502,
                'public_name' => 'Pet Shop Animalitos Maravillosos',
                'description' => 'Una persona muy buena y amable c:',
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => 'www.veroz.com',
                'verified' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => 14,
                'credential_img_id' => 15,
            ],
            [
                'id' => 3,
                'first_name' => 'Gustavo',
                'last_name' => 'Gatica',
                'email' => 'zasara@gmail.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'Argentina',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'city' => 'Ciudad de Buenos Aires',
                'district' => 'Villa Crespo',
                'postal_code' => '1414',
                'street' => 'Avenida Honorio Pueyrredón',
                'house_number' => '1280',
                'apartment' => '4F',
                'latitude' => -34.605675,
                'longitude' => -58.447150,
                'dni' => 41231512,
                'public_name' => 'Baño de perros Gustavo',
                'description' => 'Una persona que no valida y por eso es mala >:c',
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => 'www.webfalsa.com',
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => 14,
                'credential_img_id' => 16,
            ],
            [
                'id' => 4,
                'first_name' => 'Manuel',
                'last_name' => 'Jimenez',
                'email' => 'manuel@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'city' => 'Ciudad de Buenos Aires',
                'district' => 'Almagro',
                'postal_code' => '1181',
                'street' => 'Gascón',
                'house_number' => '573',
                'apartment' => '',
                'latitude' => -34.60506,
                'longitude' => -58.42437,
                'dni' => null,
                'public_name' => 'Veterinario Jimenez',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 5,
                'first_name' => 'Susanita',
                'last_name' => 'Cruz',
                'email' => 'susanita@veterinaria.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'city' => 'Ciudad de Buenos Aires',
                'district' => 'Villa Crespo',
                'postal_code' => '1414',
                'street' => 'Camargo',
                'house_number' => '572',
                'apartment' => '',
                'latitude' => -34.6001,
                'longitude' => -58.44061,
                'dni' => null,
                'public_name' => null,
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 6,
                'first_name' => 'Juan Alejandro',
                'last_name' => 'Espina',
                'email' => 'juan@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'city' => 'Ciudad de Buenos Aires',
                'district' => 'Almagro',
                'postal_code' => '1413',
                'street' => 'Estado de Palestina',
                'house_number' => '876',
                'apartment' => '',
                'latitude' => -34.60056,
                'longitude' => -58.42538,
                'dni' => null,
                'public_name' => null,
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],

            [
                'id' => 7,
                'first_name' => 'Ángelo',
                'last_name' => 'Perez',
                'email' => 'angelo@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'city' => 'Ciudad de Buenos Aires',
                'district' => 'Almagro',
                'postal_code' => '1205',
                'street' => 'Avenida Rivadavia',
                'house_number' => '4333',
                'apartment' => '',
                'latitude' => -34.61387,
                'longitude' => -58.42666,
                'dni' => null,
                'public_name' => 'Veterinario y Pet Shop',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 8,
                'first_name' => 'María',
                'last_name' => 'Gomez',
                'email' => 'maria@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Santa Fe',
                'city' => 'Rosario',
                'district' => 'Cinco Esquinas',
                'postal_code' => '2013',
                'street' => 'Avenida Pellegrini',
                'house_number' => '3979',
                'apartment' => '',
                'latitude' => -32.950423,
                'longitude' => -60.680177,
                'dni' => null,
                'public_name' => 'Bienestar animal',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 9,
                'first_name' => 'Pedro',
                'last_name' => 'Mora',
                'email' => 'pedro@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Santa Fe',
                'city' => 'Rosario',
                'district' => 'República de la 6ta',
                'postal_code' => '2013',
                'street' => 'La Paz',
                'house_number' => '879',
                'apartment' => '',
                'latitude' => -32.964831,
                'longitude' => -60.639562,
                'dni' => null,
                'public_name' => 'Clínica Integral Veterinaria',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 10,
                'first_name' => 'Juanita',
                'last_name' => 'Colón',
                'email' => 'juanita@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Córdoba',
                'city' => 'Córdoba',
                'district' => 'Teodoro Felds',
                'postal_code' => '5000',
                'street' => 'Avenida Duarte Quirós',
                'house_number' => '5275',
                'apartment' => '',
                'latitude' => -31.397020,
                'longitude' => -64.251540,
                'dni' => null,
                'public_name' => 'Colón Veterinary Clinic',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 11,
                'first_name' => 'Josefa',
                'last_name' => 'Lopez',
                'email' => 'josefa@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Córdoba',
                'city' => 'Córdoba',
                'district' => '',
                'postal_code' => '5000',
                'street' => 'Avenida Armada Argentina',
                'house_number' => '1411',
                'apartment' => '',
                'latitude' => -31.464781,
                'longitude' => -64.221182,
                'dni' => null,
                'public_name' => null,
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 12,
                'first_name' => 'Cornelius',
                'last_name' => 'Cempinsky',
                'email' => 'cornelius@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Córdoba',
                'city' => 'Córdoba',
                'district' => 'Colón',
                'postal_code' => '5000',
                'street' => 'Avenida Gobernador Amadeo Sabattini',
                'house_number' => '2350',
                'apartment' => '',
                'latitude' => -31.433295,
                'longitude' => -64.154190,
                'dni' => null,
                'public_name' => 'GLEE PET MARKET',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 13,
                'first_name' => 'Julio',
                'last_name' => 'Suipacha',
                'email' => 'julio@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Salta',
                'city' => 'Salta',
                'district' => '',
                'postal_code' => '4400',
                'street' => 'Avenida Bélgica',
                'house_number' => '1665',
                'apartment' => '',
                'latitude' => -24.804800,
                'longitude' => -65.425360,
                'dni' => null,
                'public_name' => 'Veterinaria K-chorros',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 14,
                'first_name' => 'Liliana',
                'last_name' => 'Smith',
                'email' => 'liliana@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Buenos Aires',
                'city' => 'Bahía Blanca',
                'district' => 'Kilómetro 5',
                'postal_code' => '8000',
                'street' => 'Doctor Sixto Laspiur',
                'house_number' => '1324',
                'apartment' => '',
                'latitude' => -38.715433,
                'longitude' => -62.292449,
                'dni' => null,
                'public_name' => 'Veterinaria Lihue',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 15,
                'first_name' => 'Francisca',
                'last_name' => 'Nuñez',
                'email' => 'francisca@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Río Negro',
                'city' => 'San Carlos de Bariloche',
                'district' => '',
                'postal_code' => '8400',
                'street' => 'Avenida de los Pioneros',
                'house_number' => '6000',
                'apartment' => '',
                'latitude' => -41.128154,
                'longitude' => -71.378613,
                'dni' => null,
                'public_name' => 'Clínica Veterinaria Vida',
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
                'verified' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'profile_img_id' => null,
                'credential_img_id' => null,
            ],
            [
                'id' => 16,
                'first_name' => 'Lucas',
                'last_name' => 'Sol',
                'email' => 'lucas@veterinario.com',
                'email_visible' => false,
                'password' => Hash::make('asdasdasd'),
                'country' => 'ARG',
                'state' => 'Chubut',
                'city' => 'Rawson',
                'district' => '',
                'postal_code' => '9103',
                'street' => 'Domingo Cannito',
                'house_number' => '49',
                'apartment' => '',
                'latitude' => -43.300162,
                'longitude' => -65.089641,
                'dni' => null,
                'public_name' => null,
                'description' => null,
                'whatsapp' => null,
                'instagram' => null,
                'facebook' => null,
                'web' => null,
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
                'user_type_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'user_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'user_type_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'user_id' => 3,
                'user_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'user_id' => 4,
                'user_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'user_id' => 5,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'user_id' => 6,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'user_id' => 7,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'user_id' => 7,
                'user_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'user_id' => 8,
                'user_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'user_id' => 8,
                'user_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'user_id' => 9,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'user_id' => 10,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'user_id' => 11,
                'user_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'user_id' => 11,
                'user_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'user_id' => 12,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'user_id' => 13,
                'user_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'user_id' => 14,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'user_id' => 14,
                'user_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 21,
                'user_id' => 15,
                'user_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 22,
                'user_id' => 16,
                'user_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 23,
                'user_id' => 16,
                'user_type_id' => 8,
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
                'user_id' => 1,
                'pet_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'pet_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'user_id' => 4,
                'pet_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
