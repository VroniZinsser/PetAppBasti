<?php

namespace App\Services;

use App\Models\Vaccine;
use App\Repositories\VaccineRepository;

class VaccineService implements VaccineRepository
{
    /**
     * @inheritDoc
     */
    public function getVaccinesByPet(int $pets_id): object
    {
        $vaccines = Vaccine::get()->where('pets_id', $pets_id);
        return $vaccines;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Vaccine
    {
        $vaccine = Vaccine::find($id);
        return $vaccine;
    }

    /**
     * @inheritDoc
     */
    public function create(string $name, string $date, int $pets_id): Vaccine
    {
        $vaccine = new Vaccine();
        $vaccine->name = $name;
        $vaccine->date = $date;
        $vaccine->pets_id = $pets_id;
        $vaccine->save();
        return $vaccine;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, string $name, string $date, int $pets_id): Vaccine
    {
        $vaccine = Vaccine::find($id);
        $vaccine->name = $name;
        $vaccine->date = $date;
        $vaccine->pets_id = $pets_id;
        $vaccine->save();
        return $vaccine;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        Vaccine::find($id)->delete();
        return true;
    }
}
