<?php

namespace App\Services;

use App\Dtos\PetDTO;
use App\Models\Pet;
use App\Models\User;
use App\Repositories\PetRepository;

class PetService implements PetRepository
{

    /**
     * @inheritDoc
     */
    public function updateOrCreate(PetDTO $dto, int $owner_id): Pet
    {
        $pet = Pet::updateOrCreate(
            ['id' => $dto->getId()],
            [
                'breed' => $dto->getBreed(),
                'date_of_birth' => $dto->getDate_of_birth(),
                'name' => $dto->getName(),
                'neutered' => $dto->getNeutered(),
                'temperament' => $dto->getTemperament(),
                'observation' => $dto->getObservation(),
                'images_id' => $dto->getImages_id(),
                'sexes_id' => $dto->getSexes_id(),
                'species_id' => $dto->getSpecies_id(),
            ]
        );

        $pet->owners()->attach([$owner_id]);

        return $pet;
    }

    /**
     * @inheritDoc
     */
    public function getPetsByUser(int $owner_id): object
    {
        $user = User::find($owner_id);

        $user->load(['pets', 'pets.image', 'pets.sex', 'pets.species']);

        return $user->pets;
    }

    /**
     * @inheritDoc
     */
    public function patchObservation(int $pet_id, ?string $observation): Pet
    {
        $pet = Pet::find($pet_id);
        $pet->observation = $observation;
        $pet->save();

        return $pet;
    }
}
