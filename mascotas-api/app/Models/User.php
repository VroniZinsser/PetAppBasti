<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

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
     * Returns the user's profile image
     *
     * @return BelongsTo
     */
    public function profile_image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'profile_img_id');
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
