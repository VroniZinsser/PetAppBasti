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
    public function updateOrCreate(PetDTO $dto, int $owner): Pet
    {
        $pet = Pet::findOrNew($dto->get_id());
        $pet->breed = $dto->get_breed();
        $pet->date_of_birth = $dto->get_date_of_birth();
        $pet->name = $dto->get_name();
        $pet->neutered = $dto->get_neutered();
        $pet->temperament = $dto->get_temperament();
        $pet->observation = $dto->get_observation();
        $pet->images_id = $dto->get_images_id();
        $pet->sexes_id = $dto->get_sexes_id();
        $pet->species_id = $dto->get_species_id();
        $pet->save();

        $pet->owners()->attach([$owner]);

        return $pet;
    }

    /**
     * @inheritDoc
     */
    public function getPetsByUser(int $owners_id): object
    {
        $user = User::find($owners_id);

        $user->load(['pets', 'pets.image', 'pets.sex', 'pets.species']);

        return $user->pets;
    }

    /**
     * @inheritDoc
     */
    public function updateObservation(int $pets_id, string $observation): Pet
    {
        $pet = Pet::findOrFail($pets_id);
        $pet->observation = $observation;
        $pet->save();

        return $pet;
    }
}
