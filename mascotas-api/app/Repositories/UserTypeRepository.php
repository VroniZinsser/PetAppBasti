<?php

namespace App\Repositories;

use App\Models\UserType;
use Illuminate\Database\Eloquent\Collection;

interface UserTypeRepository
{
    /**
     * Returns all the user types in the database.
     * @return UserType[]|Collection
     */
    public function getAll(): Collection;

    /**
     * Returns all the user types related to professionals.
     * @return UserType[]|Collection
     */
    public function getProfessionals(): Collection;
}