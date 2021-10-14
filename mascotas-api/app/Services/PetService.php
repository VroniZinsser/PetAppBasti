<?php

namespace App\Services;

use App\Models\Pet;
use App\Models\User;
use App\Repositories\PetRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class PetService implements PetRepository
{

    /**
     * @inheritDoc
     */
    public function updateOrCreate(?int $id, ?string $breed, ?string $date_of_birth, string $name, ?bool $neutered, ?string $temperament, ?int $images_id, int $sexes_id, int $species_id, int $owner): Pet
    {
        $pet = Pet::updateOrCreate(
            ['id' => $id],
            [
                'breed' => $breed,
                'date_of_birth' => $date_of_birth,
                'name' => $name,
                'neutered' => $neutered,
                'temperament' => $temperament,
                'images_id' => $images_id,
                'sexes_id' => $sexes_id,
                'species_id' => $species_id,
            ]
        );

        $pet->owners()->attach([$owner]);

        return $pet;
    }

    /**
     * @inheritDoc
     */
    public function getOwnerPets(int $owner_id): Collection
    {
        return User::where('id', $owner_id)->with('pets')->first()->pets;
    }
}
