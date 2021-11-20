<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    use HasFactory;

    /**
     * The medicines that belong to the hour.
     */
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class);
    }
}
