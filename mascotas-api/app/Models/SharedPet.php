<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedPet extends Model
{
    protected $table = "shared_pets";

    use HasFactory;
}
