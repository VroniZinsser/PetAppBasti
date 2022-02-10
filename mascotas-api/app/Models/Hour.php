<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hour
 *
 * @property int $id
 * @property string $time
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @method static \Illuminate\Database\Eloquent\Builder|Hour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hour query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hour whereTime($value)
 * @mixin \Eloquent
 */
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
