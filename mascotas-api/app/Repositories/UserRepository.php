<?php

namespace App\Repositories;

use App\Dtos\UserDTO;
use App\Models\User;

interface UserRepository
{

    /**
     * Retrieves users from the database that match at least with one of the given user types.
     * 
     * @param array $types
     * @return Collection | []User
     */
    public function getUsersByTypes($types): object;

    /**
     * Creates/Updates and returns a user
     * 
     * @param UserDTO $dto
     * @return User The created or updated user
     */
     public function updateOrCreate(UserDTO $dto): User;
}