<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService implements UserRepository {

    /**
     * @inheritDoc
     */
    public function getUsersByTypes($types): object
    {
        $users = User::whereHas('userTypes', function($query) use($types) {
            $query->whereIn('user_types.id', $types);
        })->get();
        
        return $users;
    }
    
    /**
     * @inheritDoc
     */
    public function updateOrCreate(
        ?int $id,  
        string $first_name, 
        string $last_name, 
        string $email, 
        ?string $email_verified_at, 
        string $password, 
        ?string $country,
        ?string $state,
        ?string $city,
        ?string $postal_code,
        ?string $district,
        ?string $street,
        ?string $house_number,
        ?string $apartment,
        ?float $latitude,
        ?float $longitude,
        ?string $dni, 
        ?string $description, 
        ?string $web, 
        ?string $phone_number, 
        ?bool $verified, 
        ?int $profile_img_id): User
    {
        $user = User::updateOrCreate(
            ['id' => $id],
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'email_verified_at' => $email_verified_at,
                'password' => Hash::make($password),
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'postal_code' => $postal_code,
                'district' => $district,
                'street' => $street,
                'house_number' => $house_number,
                'apartment' => $apartment,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'dni' => $dni,
                'description' => $description,
                'web' => $web,
                'phone_number' => $phone_number,
                'verified' => $verified,
                'profile_img_id' => $profile_img_id
            ]
        );

        return $user;
    }

}