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

    /**
     * @inheritDoc
     */
    public function getProfessionals(): Collection {
  
        return UserType::find([5,6,7,8]);
    }

}