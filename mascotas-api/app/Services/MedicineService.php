<?php

namespace App\Services;

use App\Models\Medicine;
use App\Repositories\MedicineRepository;

class MedicineService implements MedicineRepository
{
    /**
     * @inheritDoc
     */
    public function getMedicinesByPet(int $pet_id): object
    {
        return Medicine::get()->where('pets_id', $pet_id)->load('hours');
    }

    /**
     * @inheritDoc
     */
    public function create(string $name, string $quantity, string $start_date, string $end_date, int $pet_id, array $hours): Medicine
    {
        $medicine = $this->createMedicine($name, $quantity, $start_date, $end_date, $pet_id);

        $medicine->save();

        $this->addHoursToMedicine($medicine, $hours);

        return $medicine;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Medicine
    {
        return Medicine::findOrFail($id)->load('hours');
    }

    /**
     * @inheritDoc
     */
    public function update(Medicine $medicine, string $name, string $quantity, string $start_date, string $end_date, array $hours): Medicine
    {
        $medicine->name = $name;
        $medicine->quantity = $quantity;
        $medicine->start_date = $start_date;
        $medicine->end_date = $end_date;
        $medicine->save();

        $this->addHoursToMedicine($medicine, $hours);

        return $medicine;
    }

    /**
     * @inheritDoc
     */
    public function delete(Medicine $medicine): bool
    {
        $medicine->delete();

        return true;
    }

    /**
     * Creates a new medicine and returns it
     *
     * @param string $name
     * @param string $quantity
     * @param string $start_date
     * @param string $end_date
     * @param int $pet_id
     * @return Medicine
     */
    protected function createMedicine(string $name, string $quantity, string $start_date, string $end_date, int $pet_id): Medicine
    {
        $medicine = new Medicine;
        $medicine->name = $name;
        $medicine->quantity = $quantity;
        $medicine->start_date = $start_date;
        $medicine->end_date = $end_date;
        $medicine->pets_id = $pet_id;

        return $medicine;
    }

    /**
     * Add schedules to a medicine
     *
     * @param Medicine $medicine
     * @param array $hours
     */
    protected function addHoursToMedicine(Medicine $medicine, array $hours)
    {
        $medicine->hours()->sync($hours);
    }
}
