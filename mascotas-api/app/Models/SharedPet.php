<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SharedPet newModelQuery()
 * @method static Builder|SharedPet newQuery()
 * @method static Builder|SharedPet query()
 * @method static Builder|SharedPet whereAccepted($value)
 * @method static Builder|SharedPet whereCreatedAt($value)
 * @method static Builder|SharedPet whereDescription($value)
 * @method static Builder|SharedPet whereExpirationDate($value)
 * @method static Builder|SharedPet whereId($value)
 * @method static Builder|SharedPet whereOwnersId($value)
 * @method static Builder|SharedPet wherePetsId($value)
 * @method static Builder|SharedPet whereProfessionalsId($value)
 * @method static Builder|SharedPet whereUpdatedAt($value)
 * @mixin Eloquent
 */
class SharedPet extends Model
{
    protected $table = "shared_pets";

    use HasFactory, SoftDeletes;

    /**
     * Returns the related pet
     *
     * @return BelongsTo
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class, 'pets_id')->select('id', 'name', 'images_id', 'sexes_id');
    }

    /**
     * Returns the related owner
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owners_id')->select('id', 'first_name', 'last_name');
    }
}
