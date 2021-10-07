<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    /**
     * Creates/Updates and returns a user
     * 
     * @param int|null $id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param date $email_verified_at
     * @param string $password
     * @param string|null $address
     * @param string|null $dni
     * @param string|null $description
     * @param string|null $web
     * @param string|null $phone_number
     * @param boolean|null $verified
     * 
     * @return User The created or updated user
     */

    public function updateOrCreate(?int $id,  string $first_name, string $last_name, string $email, string $email_verified_at, string $password, string $address, string $dni, string $description, string $web, string $phone_number, bool $verified): User;

}