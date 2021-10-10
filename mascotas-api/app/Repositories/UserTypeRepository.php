<?php

namespace App\Repositories;

use App\Models\UserType;
use Illuminate\Database\Eloquent\Collection;

interface UserTypeRepository
{
    /**
     * Returns all the species in the database.
     * @return UserType[]|Collection
     */
    public function getAll(): Collection;
}