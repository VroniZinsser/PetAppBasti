<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SharedPet
 *
 * @property int $id
 * @property int|null $accepted
 * @property string|null $description
 * @property string $expiration_date
 * @property int $pets_id
 * @property int|null $owners_id
 * @property int|null $professionals_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet query()
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereOwnersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet wherePetsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereProfessionalsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharedPet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SharedPet extends Model
{
    protected $table = "shared_pets";

    use HasFactory;

    /**
     * Returns the related pet
     *
     * @return BelongsTo
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class, 'pets_id')->select('id', 'name', 'images_id');
    }
}
