<?php

namespace App\Services;

use App\Models\Weight;
use App\Repositories\WeightRepository;

class WeightService implements WeightRepository
{

    /**
     * @inheritDoc
     */
    public function getWeightsByPet(int $pet_id): object
    {
        return Weight::get()->where('pets_id', $pet_id);

    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Weight
    {
        return Weight::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(string $date, int $weight_number, int $pet_id): Weight
    {
        $weight = new Weight();
        $weight->date = $date;
        $weight->weight = $weight_number;
        $weight->pets_id = $pet_id;
        $weight->save();
        return $weight;
    }

    /**
     * @inheritDoc
     */
    public function update(Weight $weight, string $date, int $weight_number): Weight
    {
        $weight->date = $date;
        $weight->weight = $weight_number;
        $weight->save();
        return $weight;
    }

    /**
     * @inheritDoc
     */
    public function delete(Weight $weight): bool
    {
        $weight->delete();
        return true;
    }
}
