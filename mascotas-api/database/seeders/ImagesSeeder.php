<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    protected $petPath = null;
    protected $userProfilePath = null;

    public function __construct()
    {
        $this->petPath = 'pets/';
        $this->userProfilePath = 'users/profile/';
    }

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
                'src' => $this->petPath . 'dog.png',
                'alt' => 'Perro',
            ],
            [
                'id' => 2,
                'src' => $this->petPath . 'cat.png',
                'alt' => 'Gato',
            ],
            [
                'id' => 3,
                'src' => $this->petPath . 'rabbit.png',
                'alt' => 'Conejo',
            ],
            [
                'id' => 4,
                'src' => $this->petPath . 'hamster.png',
                'alt' => 'Hámster',
            ],
            [
                'id' => 5,
                'src' => $this->petPath . 'turtle.png',
                'alt' => 'Tortuga',
            ],
            [
                'id' => 6,
                'src' => $this->petPath . 'ferret.png',
                'alt' => 'Hurón',
            ],
            [
                'id' => 7,
                'src' => $this->petPath . 'chinchilla.png',
                'alt' => 'Chinchilla',
            ],
            [
                'id' => 8,
                'src' => $this->petPath . 'lizard.png',
                'alt' => 'Lagarto',
            ],
            [
                'id' => 9,
                'src' => $this->petPath . 'bird.png',
                'alt' => 'Pájaro',
            ],
            [
                'id' => 10,
                'src' => $this->petPath . 'miniature_pig.png',
                'alt' => 'Cerdo miniatura',
            ],
            [
                'id' => 11,
                'src' => $this->petPath . 'fish.png',
                'alt' => 'Pez',
            ],
            [
                'id' => 12,
                'src' => $this->petPath . 'other.png',
                'alt' => 'Otro tipo de animal',
            ],
            [
                'id' => 13,
                'src' => $this->userProfilePath . 'default_user.png',
                'alt' => 'Ilustración de un usuario con el rol de dueño',
            ],
            [
                'id' => 14,
                'src' => $this->userProfilePath . 'default_professional.png',
                'alt' => 'Ilustración de un usuario de tipo profesional',
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
            [
                'id' => 17,
                'src' => $this->petPath . 'cat_cris_2.jpg',
                'alt' => 'Foto del titulo del experto Zas Ara invalida',
            ],
            [
                'id' => 18,
                'src' => $this->petPath . 'cat_cris_1.jpg',
                'alt' => 'Foto del titulo del experto Zas Ara invalida',
            ],
            [
                'id' => 19,
                'src' => $this->petPath . 'dog_cris.jpg',
                'alt' => 'Foto del titulo del experto Zas Ara invalida',
            ],
            [
                'id' => 20,
                'src' => $this->userProfilePath . 'professional_male_1.jpg',
                'alt' => 'Ilustración de un usuario de tipo profesional',
            ],
            [
                'id' => 21,
                'src' => $this->userProfilePath . 'professional_male_2.jpg',
                'alt' => 'Ilustración de un usuario de tipo profesional',
            ],
            [
                'id' => 22,
                'src' => $this->userProfilePath . 'professional_female_1.jpg',
                'alt' => 'Ilustración de un usuario de tipo profesional',
            ],
            [
                'id' => 23,
                'src' => $this->userProfilePath . 'professional_female_2.jpg',
                'alt' => 'Ilustración de un usuario de tipo profesional',
            ],
            [
                'id' => 24,
                'src' => $this->userProfilePath . 'professional_female_3.jpg',
                'alt' => 'Ilustración de un usuario de tipo profesional',
            ],
        ]);
    }
}
