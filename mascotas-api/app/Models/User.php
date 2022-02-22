<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property int|null $email_visible
 * @property string $password
 * @property string|null $country
 * @property string|null $state
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $district
 * @property string|null $street
 * @property string|null $house_number
 * @property string|null $apartment
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $dni
 * @property string|null $public_name
 * @property string|null $description
 * @property string|null $whatsapp
 * @property string|null $instagram
 * @property string|null $facebook
 * @property string|null $web
 * @property int|null $verified
 * @property string|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $profile_img_id
 * @property int|null $credential_img_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pet[] $pets
 * @property-read int|null $pets_count
 * @property-read \App\Models\Image|null $profile_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserType[] $userTypes
 * @property-read int|null $user_types_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCredentialImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePublicName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWhatsapp($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'email_visible',
        'password',
        'country',
        'state',
        'city',
        'postal_code',
        'district',
        'street',
        'house_number',
        'apartment',
        'latitude',
        'longitude',
        'dni',
        'public_name',
        'description',
        'whatsapp',
        'instagram',
        'facebook',
        'web',
        'verified',
        'profile_img_id',
    ];

    protected $appends = [
        'is_professional'
    ];

    /**
     * The user types that belong to the user.
     */
    public function userTypes(): BelongsToMany
    {
        return $this->belongsToMany(UserType::class, 'users_has_user_types');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns related pets
     *
     * @return BelongsToMany
     */
    public function pets(): BelongsToMany
    {
        return $this->belongsToMany(Pet::class, 'users_has_pets', 'user_id', 'pet_id');
    }

    /**
     * Returns all requests to share a pet that are related to a professional
     *
     * @return HasMany
     */
    public function requestsProfessional(): HasMany
    {
        return $this->hasMany(SharedPet::class, 'professionals_id', 'id');
    }

    /**
     * Returns all professionals that are related to a pet owner because they got a request to share a pet
     *
     * @return BelongsToMany
     */
    public function relatedProfessionals(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shared_pets', 'owners_id', 'professionals_id')->select('users.id', 'first_name', 'last_name');
    }

    /** Returns the user's profile image
     *
     * @return BelongsTo
     */
    public function profile_image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'profile_img_id');
    }

    /** 
     * Returns true if the user has at least one user type that belongs to professional user
     *
     * @return bool
     */
    public function getIsProfessionalAttribute(): bool
    {
        foreach ($this->userTypes as $type) {
            if (in_array($type->id, [5, 6, 7, 8])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
