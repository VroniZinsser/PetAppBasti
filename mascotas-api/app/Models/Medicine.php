<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Medicine
 *
 * @property int $id
 * @property string $name
 * @property string $quantity
 * @property string $start_date
 * @property string $end_date
 * @property int $pets_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hour[] $hours
 * @property-read int|null $hours_count
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine wherePetsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereUpdatedAt($value)
 * @mixin \Eloquent
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
