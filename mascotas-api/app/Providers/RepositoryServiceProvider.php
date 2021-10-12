<?php

namespace App\Providers;

use App\Repositories\ImageRepository;
use App\Repositories\PetRepository;
use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use App\Services\ImageService;
use App\Services\PetService;
use App\Services\SexService;
use App\Services\SpeciesService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        ImageRepository::class => ImageService::class,
        PetRepository::class => PetService::class,
        SexRepository::class => SexService::class,
        SpeciesRepository::class => SpeciesService::class,
    ];
}
