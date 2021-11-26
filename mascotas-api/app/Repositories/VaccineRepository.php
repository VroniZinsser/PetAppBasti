<?php

namespace App\Repositories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Collection;

interface VaccineRepository
{
    /**
     * Returns all vaccines that belong to a pet with the given id
     *
     * @param int $pet_id
     * @return Collection | []Vaccine
     */
    public function getVaccinesByPet(int $pet_id): object;

    /**
     * Returns the vaccine with the given id
     *
     * @param int $id
     * @return Vaccine
     */
    public function find(int $id): Vaccine;

    /**
     * Creates, inserts and returns the vaccine
     *
     * @param string $name
     * @param string $date
     * @param int $pet_id
     * @return Vaccine The inserted vaccine
     */
    public function create (string $name, string $date, int $pet_id): Vaccine;

    /**
     * Updates and returns the vaccine with the given id
     *
     * @param int $id
     * @param string $name
     * @param string $date
     * @return Vaccine The updated vaccine
     */
    public function update (int $id, string $name, string $date): Vaccine;

    /**
     * Deletes the vaccine with the given id and returns true if deletion was successful
     *
     * @param int $id
     * @return boolean success
     */
    public function delete (int $id): bool;

}
