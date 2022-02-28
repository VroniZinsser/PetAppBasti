<?php

namespace App\Repositories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Collection;

interface MedicineRepository
{
    /**
     * Returns all vaccines that belong to a pet with the given id
     *
     * @param int $pet_id
     * @return Collection | []Vaccine
     */
    public function getMedicinesByPet(int $pet_id): object;

    /**
     * Creates, inserts and returns the medicine
     *
     * @param string $name
     * @param string $quantity
     * @param string $start_date
     * @param string $end_date
     * @param int $pet_id
     * @param array $hours
     * @return Medicine
     */
    public function create(string $name, string $quantity, string $start_date, string $end_date, int $pet_id, array $hours): Medicine;

    /**
     * Returns the medicine with the given id
     *
     * @param int $id
     * @return Medicine
     */
    public function find(int $id): Medicine;

    /**
     * Updates and returns the medicine with the given id
     *
     * @param Medicine $medicine
     * @param string $name
     * @param string $quantity
     * @param string $start_date
     * @param string $end_date
     * @param array $hours
     * @return Medicine The updated medicine
     */
    public function update(Medicine $medicine, string $name, string $quantity, string $start_date, string $end_date, array $hours): Medicine;

    /**
     * Deletes the medicine with the given id and returns true if deletion was successful
     *
     * @param Medicine $medicine
     * @return boolean success
     */
    public function delete(Medicine $medicine): bool;
}
