<?php

namespace App\Services;

use App\Models\Sex;
use App\Repositories\SexRepository;
use Illuminate\Database\Eloquent\Collection;

class SexService implements SexRepository
{
    /**
     * @inheritDoc
     */
    public function getAll(): Collection
    {
        return Sex::all();
    }
}
