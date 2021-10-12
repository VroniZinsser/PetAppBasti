<?php

namespace App\Services;

use App\Models\Pet;
use App\Repositories\PetRepository;

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
}
