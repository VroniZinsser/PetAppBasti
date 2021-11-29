<?php

namespace App\Repositories;

use App\Models\Medicine;

interface MedicineRepository
{
    /**
     * Add a new medication to a pet
     *
     * @param string $name
     * @param string $quantity
     * @param string $start_date
     * @param string $end_date
     * @param int $pet_id
     * @param array $hours
     * @return Medicine
     */
    public function add(string $name, string $quantity, string $start_date, string $end_date, int $pet_id, array $hours): Medicine;

    /**
     * Returns all medicines that belong to a pet with the given id
     * 
     * @param int $petId
     * @return Collection | []Vaccine
     */
    public function getMedicinesByPet(int $petId): object;
}
