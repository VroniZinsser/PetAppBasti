<?php

namespace App\Repositories;

use App\Models\Sex;
use Illuminate\Database\Eloquent\Collection;

interface SexRepository
{

    /**
     * Returns all the sexes in the database.
     * @return Sex[]|Collection
     */
    public function getAll(): Collection;
}
