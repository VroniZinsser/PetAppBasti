<?php

namespace App\Repositories;

use App\Dtos\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{

    /**
     * Retrieves users from the database that match at least with one of the given user types.
     *
     * @param array $types
     * @return Collection | []User
     */
    public function getUsersByTypes(array $types): object;

    /**
     * Creates/Updates and returns a user
     *
     * @param UserDTO $dto
     * @return User The created or updated user
     */
     public function updateOrCreate(UserDTO $dto): User;

     /**
     * Returns the user with the given id
     *
     * @param int $id
     * @return User
     */
    public function find(int $id): User;

    /**
     * Deletes the user with the given id and returns true if deletion was successful
     *
     * @param int $id
     * @return boolean success
     */
    public function delete (int $id): bool;
}
