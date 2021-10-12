<?php

namespace App\Services;

use App\Models\Species;
use App\Repositories\SpeciesRepository;
use Illuminate\Database\Eloquent\Collection;

class SpeciesService implements SpeciesRepository
{
    /**
     * @inheritDoc
     */
    public function getAll(): Collection
    {
        return Species::all();
    }
}
