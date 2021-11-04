<?php

namespace App\Providers;

use App\Repositories\ImageRepository;
use App\Repositories\PetRepository;
use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTypeRepository;
use App\Repositories\WeightRepository;
use App\Services\ImageService;
use App\Services\PetService;
use App\Services\SexService;
use App\Services\SpeciesService;
use App\Services\UserTypeService;
use App\Services\UserService;
use App\Services\WeightService;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepository::class => UserService::class,
        UserTypeRepository::class => UserTypeService::class,
        ImageRepository::class => ImageService::class,
        PetRepository::class => PetService::class,
        SexRepository::class => SexService::class,
        SpeciesRepository::class => SpeciesService::class,
        WeightRepository::class => WeightService::class
    ];
}
