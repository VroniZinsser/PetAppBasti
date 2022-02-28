<?php

namespace App\Repositories;

use App\Dtos\PetDTO;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface PetRepository
{
    /**
     * Creates or Updates and returns the pet
     *
     * @param PetDTO $dto
     * @param int $owner_id
     * @return Pet The created or updated pet
     */
    public function updateOrCreate(PetDTO $dto, int $owner_id): Pet;

    /**
     * @param int $owner_id
     * @return Collection | []Pet
     */
    public function getPetsByUser(int $owner_id): object;

    /**
     * @param Pet $pet
     * @param string $observation
     * @return Pet The patched pet
     * @throws ModelNotFoundException
     */
    public function updateObservation(Pet $pet, string $observation): Pet;

    /**
     * Returns the pet with the given id
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Return the pet with the given id and its relations.
     *
     * @param int $id
     * @return mixed
     */
    public function findWithRelationship(int $id);

    /**
     * Deletes the pet with the given id and returns true if deletion was successful
     *
     * @param Pet $pet
     * @return boolean success
     */
    public function delete (Pet $pet): bool;

    /**
     * Returns true if the given user id matches with the owners of the pet
     *
     * @param int $user_id
     * @param int $pet_id
     * @return boolean
     */
    public function isOwner(int $user_id, int $pet_id): Bool;

    public function getObservation(int $pet_id);
}
