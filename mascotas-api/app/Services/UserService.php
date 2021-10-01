<?php

namespace App\Services;

class UserService implements UserRepository {
    
    public function updateOrCreate(?int $id, string $first_name, string $last_name, string $email, date $email_verified_at, string $password, string $address, string $dni, string $description, string $web, string $phone_number, boolean $verified): \App\Models\Smoothie
    {
        $user = User::updateOrCreate(
            ['id' => $id],
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'email_verified_at' => $email_verified_at,
                'password' => $password,
                'address' => $address,
                'dni' => $dni,
                'description' => $description,
                'web' => $web,
                'phone_number' => $phone_number,
                'verified' => $verified
            ]
        );

        return $user;
    }

}