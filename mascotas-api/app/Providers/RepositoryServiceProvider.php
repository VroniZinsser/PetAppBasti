<?php

namespace App\Providers;

use App\Repositories\ContactRepository;
use App\Repositories\HourRepository;
use App\Repositories\ImageRepository;
use App\Repositories\MedicineRepository;
use App\Repositories\PetRepository;
use App\Repositories\SexRepository;
use App\Repositories\SpeciesRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTypeRepository;
use App\Repositories\VaccineRepository;
use App\Repositories\WeightRepository;
use App\Services\ContactService;
use App\Services\HourService;
use App\Services\ImageService;
use App\Services\MedicineService;
use App\Services\PetService;
use App\Services\SexService;
use App\Services\SpeciesService;
use App\Services\UserTypeService;
use App\Services\UserService;
use App\Services\VaccineService;
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
        MedicineRepository::class => MedicineService::class,
        VaccineRepository::class => VaccineService::class,
        WeightRepository::class => WeightService::class,
        HourRepository::class => HourService::class,
        ContactRepository::class => ContactService::class
    ];
}
