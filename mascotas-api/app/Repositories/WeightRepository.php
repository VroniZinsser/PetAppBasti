<?php

namespace App\Repositories;

use App\Models\Weight;
use Illuminate\Database\Eloquent\Collection;

interface PetRepository
{
    /**
     * @param int $pet_id
     * @return Collection | []Weight
     */
    public function getWeightsByPet(int $pet_id): object;

    /**
     * Inserts and returns the weight
     *
     * @param string $date_time
     * @param int $weight
     * @param int $pets_id
     * @return Weight The inserted weight
     */
    public function insert (string $date_time, int $weight, int $pets_id): Weight;

    /**
     * Updates and returns the weight with the given id
     *
     * @param int $id
     * @param string $date_time
     * @param int $weight
     * @param int $pets_id
     * @return Weight The inserted weight
     */
    public function update (int $id, string $date_time, int $weight, int $pets_id): Weight;

    /**
     * Deletes the weight with the given id and returns true if deletion was successful
     *
     * @param int $id
     * @return boolean success
     */
    public function delete (int $id): bool;
}
