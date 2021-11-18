<?php

namespace App\Repositories;

use App\Dtos\PetDTO;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Collection;

interface PetRepository
{
    /**
     * Creates or Updates and returns the pet
     * 
     * @param PetDTO $dto
     * @param int $owners_id
     * @return Pet The created or updated pet
     */
    public function updateOrCreate(PetDTO $dto, int $owners_id): Pet;

    /**
     * @param int $owners_id
     * @return Collection | []Pet
     */
    public function getPetsByUser(int $owners_id): object;

    /**
     * @param int $pets_id
     * @param string|null $observation
     * @return Pet The patched pet
     */
    public function patchObservation(int $pets_id, ?string $observation): Pet | bool;
}
