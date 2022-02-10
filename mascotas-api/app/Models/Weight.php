<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Weight
 *
 * @property int $id
 * @property string $date
 * @property int $weight
 * @property int $pets_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pet $pet
 * @method static \Illuminate\Database\Eloquent\Builder|Weight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weight query()
 * @method static \Illuminate\Database\Eloquent\Builder|Weight whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weight whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weight wherePetsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weight whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weight whereWeight($value)
 * @mixin \Eloquent
 */
class Weight extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'weight',
    ];

    /**
     * Returns the related pet
     *
     * @return BelongsTo
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class, 'pets_id');
    }
}
