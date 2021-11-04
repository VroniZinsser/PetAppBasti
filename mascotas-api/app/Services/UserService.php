<?php

namespace App\Services;

use App\Dtos\UserDTO;
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
    public function updateOrCreate(UserDTO $dto): User {
        $user = User::updateOrCreate(
            ['id' => $dto->getId() ],
            [
                'first_name' => $dto->getFirst_name(),
                'last_name' => $dto->getLast_name(),
                'email' => $dto->getEmail(),
                'email_verified_at' => $dto->getEmail_verified_at(),
                'email_visible' => $dto->getEmail_visible(),
                'password' => Hash::make($dto->getPassword()),
                'country' => $dto->getCountry(),
                'state' => $dto->getState(),
                'city' => $dto->getCity(),
                'postal_code' => $dto->getPostal_code(),
                'district' => $dto->getDistrict(),
                'street' => $dto->getStreet(),
                'house_number' => $dto->getHouse_number(),
                'apartment' => $dto->getApartment(),
                'latitude' => $dto->getLatitude(),
                'longitude' => $dto->getLongitude(),
                'dni' => $dto->getDni(),
                'public_name' => $dto->getPublic_name(),
                'description' => $dto->getDescription(),
                'whatsapp' => $dto->getWhatsapp(),
                'instagram' => $dto->getInstagram(),
                'facebook' => $dto->getFacebook(),
                'web' => $dto->getWeb(),
                'verified' => $dto->getVerified(),
                'profile_img_id' => $dto->getProfile_img_id()
            ]
        );

        return $user;
    }
}