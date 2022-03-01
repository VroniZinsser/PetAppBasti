<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Hour
 *
 * @property int $id
 * @property string $time
 * @property-read Collection|Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @method static Builder|Hour newModelQuery()
 * @method static Builder|Hour newQuery()
 * @method static Builder|Hour query()
 * @method static Builder|Hour whereId($value)
 * @method static Builder|Hour whereTime($value)
 * @mixin Eloquent
 */
class Hour extends Model
{
    use HasFactory;

    /**
     * The medicines that belong to the hour.
     */
    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class);
    }
}
