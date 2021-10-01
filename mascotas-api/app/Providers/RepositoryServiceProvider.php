<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Services\UserService;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepository::class => UserService::class,

    ];
}
