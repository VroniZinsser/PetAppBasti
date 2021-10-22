<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService implements UserRepository {
    
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
        ?string $address,
        ?string $country,
        ?string $state,
        ?string $city,
        ?string $postal_code,
        ?string $district,
        ?string $street,
        ?string $house_number,
        ?string $appartment,
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
                'address' => $address,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'postal_code' => $postal_code,
                'district' => $district,
                'street' => $street,
                'house_number' => $house_number,
                'appartment' => $appartment,
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