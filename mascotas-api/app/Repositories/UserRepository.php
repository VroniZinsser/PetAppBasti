<?php

namespace App\Repositories;

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
     * @param string $address
     * @param string $dni
     * @param string $description
     * @param string $web
     * @param string $phone_number
     * @param boolean $verified
     * 
     * @return User The created or updated user
     */

    public function updateOrCreate(?int $id,  string $first_name, string $last_name, string $email, date $email_verified_at, string $password, string $address, string $dni, string $description, string $web, string $phone_number, boolean $verified): User;

}