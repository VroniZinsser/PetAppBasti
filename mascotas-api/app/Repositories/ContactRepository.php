<?php

namespace App\Repositories;

use App\Models\SharedPet;
use Illuminate\Database\Eloquent\Collection;

interface ContactRepository
{
    public function getOwnerSharedPets(int $owner_id): Collection;

    public function getProfessionalSharedPets(int $professional_id): Collection;

    public function createSharedPetRequest(?string $description, string $expiration_date, int $pet_id, int $owner_id, int $professional_id): SharedPet;

    public function updateSharedPetRequest(int $id, ?string $description, string $expiration_date, int $pet_id): SharedPet;

    public function acceptSharedPetRequest(int $id);

    public function deleteSharedPetRequest(int $id): bool;
}
