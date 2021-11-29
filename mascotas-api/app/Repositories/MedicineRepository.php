<?php

namespace App\Repositories;

use App\Models\Medicine;

interface MedicineRepository
{
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
     * @param int $id
     * @param string $name
     * @param string $quantity
     * @param string $start_date
     * @param string $end_date
     * @param array $hours
     * @return Medicine The updated medicine
     */
    public function update(int $id, string $name, string $quantity, string $start_date, string $end_date, array $hours): Medicine;

    /**
     * Deletes the medicine with the given id and returns true if deletion was successful
     *
     * @param int $id
     * @return boolean success
     */
    public function delete(int $id): bool;
}
