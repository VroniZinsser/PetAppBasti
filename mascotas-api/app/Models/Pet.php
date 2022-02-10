<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Pet
 *
 * @property int $id
 * @property string $name
 * @property string|null $breed
 * @property string|null $temperament
 * @property int|null $neutered
 * @property string|null $date_of_birth
 * @property string|null $observation
 * @property string|null $deleted_at
 * @property int $images_id
 * @property int $sexes_id
 * @property int $species_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Image $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $owners
 * @property-read int|null $owners_count
 * @property-read \App\Models\Sex $sex
 * @property-read \App\Models\Species $species
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vaccine[] $vaccines
 * @property-read int|null $vaccines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Weight[] $weights
 * @property-read int|null $weights_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereImagesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereNeutered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereSexesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereSpeciesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereTemperament($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'breed',
        'date_of_birth',
        'name',
        'neutered',
        'temperament',
        'observation',
        'images_id',
        'sexes_id',
        'species_id',
    ];

    /**
     * Returns the pet's sex
     *
     * @return BelongsTo
     */
    public function sex(): BelongsTo
    {
        return $this->belongsTo(Sex::class, 'sexes_id');
    }

    /**
     * Returns the pet's species
     *
     * @return BelongsTo
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    } 

    /**
     * Returns the pet's image
     *
     * @return BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'images_id');
    } 

    /**
     * Returns pet owners
     *
     * @return BelongsToMany
     */
    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_has_pets', 'pet_id', 'user_id');
    }

    /**
     * Get the medicines of the pet.
     */
    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'pets_id');
    }

    /**
     * Get the vaccines of the pet.
     */
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class, 'pets_id');
    }

    /**
     * Get the weights of the pet.
     */
    public function weights()
    {
        return $this->hasMany(Weight::class, 'pets_id');
    }
}
