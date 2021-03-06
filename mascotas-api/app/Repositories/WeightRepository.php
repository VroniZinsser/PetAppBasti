<?php

namespace App\Repositories;

use App\Models\Weight;
use Illuminate\Database\Eloquent\Collection;

interface WeightRepository
{
    /**
     * Returns all weights that belong to a pet with the given id
     *
     * @param int $pet_id
     * @return Collection | []Weight
     */
    public function getWeightsByPet(int $pet_id): object;

    /**
     * Returns the weight with the given id
     *
     * @param int $id
     * @return Weight
     */
    public function find(int $id): Weight;

    /**
     * Creates, inserts and returns the weight
     *
     * @param string $date
     * @param int $weight_number
     * @param int $pet_id
     * @return Weight The inserted weight
     */
    public function create (string $date, int $weight_number, int $pet_id): Weight;

    /**
     * Updates and returns the weight with the given id
     *
     * @param Weight $weight
     * @param string $date
     * @param int $weight_number
     * @return Weight The updated weight
     */
    public function update (Weight $weight, string $date, int $weight_number): Weight;

    /**
     * Deletes the weight with the given id and returns true if deletion was successful
     *
     * @param Weight $weight
     * @return boolean success
     */
    public function delete (Weight $weight): bool;
}
