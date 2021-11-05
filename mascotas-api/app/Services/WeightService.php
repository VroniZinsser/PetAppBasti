<?php

namespace App\Services;

use App\Models\Weight;
use App\Repositories\WeightRepository;

class WeightService implements WeightRepository
{

    /**
     * @inheritDoc
     */
    public function getWeightsByPet(int $pets_id): object
    {
        $weights = Weight::get()->where('pets_id', $pets_id);
        return $weights;

    }

    /**
     * @inheritDoc
     */
    public function find(int $id): object
    {
        $weight = Weight::find($id);
        return $weight;
    }

    /**
     * @inheritDoc
     */
    public function create(string $date, int $weight_data, int $pets_id): Weight
    {
        $weight = new Weight();
        $weight->date = $date;
        $weight->weight = $weight_data;
        $weight->pets_id = $pets_id;
        $weight->save();
        return $weight;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, string $date, int $weight_data, int $pets_id): Weight
    {
        $weight = Weight::find($id);
        $weight->date = $date;
        $weight->weight = $weight_data;
        $weight->pets_id = $pets_id;
        $weight->save();
        return $weight;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        Weight::find($id)->delete();
        return true;
    }
}
