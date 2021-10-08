<?php

namespace App\Repositories;

use App\Models\Species;
use Illuminate\Database\Eloquent\Collection;

interface SpeciesRepository
{

    /**
     * Returns all the species in the database.
     * @return Species[]|Collection
     */
    public function getAll(): Collection;
}
