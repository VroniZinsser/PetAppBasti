<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Weight
 *
 * @property int $id
 * @property string $date
 * @property int $weight
 * @property int $pets_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Pet $pet
 * @method static Builder|Weight newModelQuery()
 * @method static Builder|Weight newQuery()
 * @method static Builder|Weight query()
 * @method static Builder|Weight whereCreatedAt($value)
 * @method static Builder|Weight whereDate($value)
 * @method static Builder|Weight whereId($value)
 * @method static Builder|Weight wherePetsId($value)
 * @method static Builder|Weight whereUpdatedAt($value)
 * @method static Builder|Weight whereWeight($value)
 * @mixin Eloquent
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
