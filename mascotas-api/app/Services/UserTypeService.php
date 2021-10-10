<?php

namespace App\Services;

use App\Models\UserType;
use App\Repositories\UserTypeRepository;
use Illuminate\Database\Eloquent\Collection;

class UserTypeService implements UserTypeRepository {
     /**
     * @inheritDoc
     */
    public function getAll(): Collection {
  
        return UserType::all();
    }

}