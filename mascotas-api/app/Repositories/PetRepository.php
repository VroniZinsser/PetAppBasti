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
     * @param int $pet_id
     * @param string $observation
     * @return Pet The patched pet
     * @throws ModelNotFoundException
     */
    public function updateObservation(int $pet_id, string $observation): Pet;
}
