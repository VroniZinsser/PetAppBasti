<?php

namespace App\Repositories;

use App\Models\SharedPet;
use Illuminate\Database\Eloquent\Collection;

interface ContactRepository
{
    /**
     * Returns the shared pet request with the given id
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Gets all requests created by the user, grouped by the professionals who recieved the requests
     *
     * @param int $owner_id
     * @return Collection
     */
    public function getRequestsByProfessional(int $owner_id): Collection;

    /**
     * Gets all requests created by the user
     *
     * @param int $owner_id
     * @return Collection
     */
    public function getOwnerSharedPets(int $owner_id): Collection;

    /**
     * Gets all requests accepted as a professional user
     *
     * @param int $professional_id
     * @return Collection
     */
    public function getProfessionalSharedPets(int $professional_id): Collection;

    /**
     * Create a new request
     *
     * @param string|null $description
     * @param string $expiration_date
     * @param int $pet_id
     * @param int $owner_id
     * @param int $professional_id
     * @return SharedPet
     */
    public function createSharedPetRequest(?string $description, string $expiration_date, int $pet_id, int $owner_id, int $professional_id): SharedPet;

    /**
     * Edits a request already registered in the database
     *
     * @param int $id
     * @param string|null $description
     * @param string $expiration_date
     * @param int $pet_id
     * @return SharedPet
     */
    public function updateSharedPetRequest(int $id, ?string $description, string $expiration_date, int $pet_id): SharedPet;

    /**
     * Changes the value of the "accepted" field to a true value
     *
     * @param int $id
     * @return mixed
     */
    public function acceptSharedPetRequest(int $id);

    /**
     * Searches the database for a request.
     *
     * @param int $id
     * @return mixed
     */
    public function findSharedPetRequest(int $id);

    /**
     * Removes a request from the database
     *
     * @param int $id
     * @return bool
     */
    public function deleteSharedPetRequest(int $id): bool;
}
