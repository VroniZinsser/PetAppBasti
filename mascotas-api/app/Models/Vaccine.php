<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Vaccine
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $pets_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pet $pet
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine wherePetsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccine whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
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
