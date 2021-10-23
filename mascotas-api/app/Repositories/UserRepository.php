<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{

    /**
     * Retrieves users from the database that match at least with one of the given user types.
     * 
     * @param array $types
     * @return Collection | []User
     */
    public function getUsersByTypes($types): object;

    /**
     * Creates/Updates and returns a user
     * 
     * @param int|null $id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param date|null $email_verified_at
     * @param string $password
     * @param string|null $address
     * @param string|null $dni
     * @param string|null $description
     * @param string|null $web
     * @param string|null $phone_number
     * @param boolean|null $verified
     * @param int|null $profile_img_id
     * 
     * @return User The created or updated user
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
        ?int $profile_img_id): User;

}