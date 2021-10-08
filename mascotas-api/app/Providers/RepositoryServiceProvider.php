<?php

namespace App\Providers;

use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use App\Services\SexService;
use App\Services\SpeciesService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        SexRepository::class => SexService::class,
        SpeciesRepository::class => SpeciesService::class
    ];
}
