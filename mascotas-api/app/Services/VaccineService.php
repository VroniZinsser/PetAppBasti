<?php

namespace App\Services;

use App\Models\Vaccine;
use App\Repositories\VaccineRepository;

class VaccineService implements VaccineRepository
{
    /**
     * @inheritDoc
     */
    public function getVaccinesByPet(int $pet_id): object
    {
        return Vaccine::get()->where('pets_id', $pet_id);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Vaccine
    {
        return Vaccine::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(string $name, string $date, int $pet_id): Vaccine
    {
        $vaccine = new Vaccine();
        $vaccine->name = $name;
        $vaccine->date = $date;
        $vaccine->pets_id = $pet_id;

        $vaccine->save();

        return $vaccine;
    }

    /**
     * @inheritDoc
     */
    public function update(Vaccine $vaccine, string $name, string $date): Vaccine
    {
        $vaccine->name = $name;
        $vaccine->date = $date;

        $vaccine->save();

        return $vaccine;
    }

    /**
     * @inheritDoc
     */
    public function delete(Vaccine $vaccine): bool
    {
        $vaccine->delete();

        return true;
    }
}
