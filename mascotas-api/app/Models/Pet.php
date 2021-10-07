<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'temperament',
        'neutered',
        'date_of_birth',
        'images_id',
        'sexes_id',
        'species_id',
    ];

    public function sex(): BelongsTo
    {
        return $this->belongsTo(Sex::class);
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_has_pets', 'pet_id', 'user_id');
    }
}
