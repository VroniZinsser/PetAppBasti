<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Vaccine
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $pets_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Pet $pet
 * @method static Builder|Vaccine newModelQuery()
 * @method static Builder|Vaccine newQuery()
 * @method static Builder|Vaccine query()
 * @method static Builder|Vaccine whereCreatedAt($value)
 * @method static Builder|Vaccine whereDate($value)
 * @method static Builder|Vaccine whereId($value)
 * @method static Builder|Vaccine whereName($value)
 * @method static Builder|Vaccine wherePetsId($value)
 * @method static Builder|Vaccine whereUpdatedAt($value)
 * @mixin Eloquent
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
