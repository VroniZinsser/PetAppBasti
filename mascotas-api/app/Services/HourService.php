<?php

namespace App\Services;

use App\Models\Hour;
use App\Repositories\HourRepository;
use Illuminate\Database\Eloquent\Collection;

class HourService implements HourRepository
{

    public function getAll(): Collection
    {
        return Hour::all();
    }
}
