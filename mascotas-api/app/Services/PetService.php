<?php

namespace App\Services;

use App\Dtos\PetDTO;
use App\Models\Pet;
use App\Models\User;
use App\Repositories\PetRepository;
use Exception;

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

        if ($pet->id !== $dto->get_id())
            $pet->owners()->attach([$owner_id]);

        return $pet;
    }

    /**
     * @inheritDoc
     */
    public function getPetsByUser(int $owner_id): object
    {
        $user = User::find($owner_id);

        $user->load(['pets', 'pets.image', 'pets.sex', 'pets.species', 'pets.medicines', 'pets.vaccines', 'pets.weights', 'pets.medicines.hours']);

        return $user->pets;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id)
    {
        return Pet::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findWithRelationship(int $id)
    {
        try {
            $pet = Pet::where('id', $id)->with('sex','species','image','owners','medicines','vaccines','weights','medicines.hours')->first();
        } catch (Exception $exception) {
            return $exception;
        }
        return $pet;
    }

    /**
     * @inheritDoc
     */
    public function delete(Pet $pet): bool
    {
        $pet->delete();

        return true;
    }

    /**
     * @inheritDoc
     */

    public function updateObservation(Pet $pet, string $observation): Pet
    {
        $pet->observation = $observation;

        $pet->save();

        return $pet;
    }

    /**
     * @inheritDoc
     */
    public function isOwner(int $user_id, int $pet_id): bool
    {
        $owner = Pet::find($pet_id)->owners()->find($user_id);

        return $owner !== null;
    }

    public function getObservation(int $pet_id)
    {
        $pet = Pet::find($pet_id);

        return $pet->observation;
    }
}
