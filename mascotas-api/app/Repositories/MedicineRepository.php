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
}
