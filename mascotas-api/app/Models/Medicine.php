<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Medicine
 *
 * @property int $id
 * @property string $name
 * @property string $quantity
 * @property string $start_date
 * @property string $end_date
 * @property int $pets_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Hour[] $hours
 * @property-read int|null $hours_count
 * @method static Builder|Medicine newModelQuery()
 * @method static Builder|Medicine newQuery()
 * @method static Builder|Medicine query()
 * @method static Builder|Medicine whereCreatedAt($value)
 * @method static Builder|Medicine whereEndDate($value)
 * @method static Builder|Medicine whereId($value)
 * @method static Builder|Medicine whereName($value)
 * @method static Builder|Medicine wherePetsId($value)
 * @method static Builder|Medicine whereQuantity($value)
 * @method static Builder|Medicine whereStartDate($value)
 * @method static Builder|Medicine whereUpdatedAt($value)
 * @mixin Eloquent
 */
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
