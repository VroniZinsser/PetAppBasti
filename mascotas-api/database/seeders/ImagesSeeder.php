<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'id' => 1,
                'src' => 'dog.png',
                'alt' => 'Perro',
            ],
            [
                'id' => 2,
                'src' => 'cat.png',
                'alt' => 'Gato',
            ],
            [
                'id' => 3,
                'src' => 'rabbit.png',
                'alt' => 'Conejo',
            ],
            [
                'id' => 4,
                'src' => 'hamster.png',
                'alt' => 'Hámster',
            ],
            [
                'id' => 5,
                'src' => 'turtle.png',
                'alt' => 'Tortuga',
            ],
            [
                'id' => 6,
                'src' => 'ferret.png',
                'alt' => 'Hurón',
            ],
            [
                'id' => 7,
                'src' => 'chinchilla.png',
                'alt' => 'Chinchilla',
            ],
            [
                'id' => 8,
                'src' => 'lizard.png',
                'alt' => 'Lagarto',
            ],
            [
                'id' => 9,
                'src' => 'bird.png',
                'alt' => 'Pájaro',
            ],
            [
                'id' => 10,
                'src' => 'miniature_pig.png',
                'alt' => 'Cerdo miniatura',
            ],
            [
                'id' => 11,
                'src' => 'fish.png',
                'alt' => 'Pez',
            ],
            [
                'id' => 12,
                'src' => 'other.png',
                'alt' => 'Otro tipo de animal',
            ],
            [
                'id' => 13,
                'src' => 'default_user.png',
                'alt' => 'Ilustración de un usuario con el rol de dueño',
            ],
            [
                'id' => 14,
                'src' => 'expert.png',
                'alt' => 'Ilustración de un usuario con el rol de experto',
            ],
            [
                'id' => 15,
                'src' => 'credential.jpg',
                'alt' => 'Foto del titulo del experto Sar Aza',
            ],
            [
                'id' => 16,
                'src' => 'credential.jpg',
                'alt' => 'Foto del titulo del experto Zas Ara invalida',
            ],
        ]);
    }
}
