<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'quantity',
      'start_date',
      'end_date',
    ];

    public function hours(): BelongsToMany
    {
        return $this->belongsToMany(Hour::class, 'medicines_has_hours', 'medicines_id', 'hours_id');
    }
}
