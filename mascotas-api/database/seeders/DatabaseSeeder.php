<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ImagesSeeder::class);
        $this->call(SexesSeeder::class);
        $this->call(SpeciesSeeder::class);
        $this->call(PetsSeeder::class);
        $this->call(WeightsSeeder::class);
        $this->call(UserTypesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SharedPetsSeeder::class);
        $this->call(AttentionSchedulesSeeder::class);
        $this->call(HoursSeeder::class);
        $this->call(MedicinesSeeder::class);
        $this->call(VaccinesSeeder::class);
    }
}
