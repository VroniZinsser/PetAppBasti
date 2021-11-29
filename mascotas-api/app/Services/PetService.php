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
        $pet = Pet::findOrNew($dto->get_id());
        $pet->breed = $dto->get_breed();
        $pet->date_of_birth = $dto->get_date_of_birth();
        $pet->name = $dto->get_name();
        $pet->neutered = $dto->get_neutered();
        $pet->temperament = $dto->get_temperament();
        $pet->observation = $dto->get_observation();
        $pet->images_id = $dto->get_image_id();
        $pet->sexes_id = $dto->get_sex_id();
        $pet->species_id = $dto->get_species_id();

        $pet->save();

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
    public function find(int $id): Pet
    {
        return Pet::find($id);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        Pet::find($id)->delete();

        return true;
    }

    /**
     * @inheritDoc
     */

    public function updateObservation(int $pet_id, string $observation): Pet
    {
        $pet = Pet::findOrFail($pet_id);
        $pet->observation = $observation;

        $pet->save();

        return $pet;
    }
}
