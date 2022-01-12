<?php

namespace App\Services;

use App\Models\SharedPet;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\Collection;

class ContactService implements ContactRepository
{

    /**
     * @inheritDoc
     */
    public function getOwnerSharedPets(int $owner_id): Collection
    {
        return SharedPet::where('owners_id', $owner_id)->get();
    }

    /**
     * @inheritDoc
     */
    public function getProfessionalSharedPets(int $professional_id): Collection
    {
        return SharedPet::where('professionals_id', $professional_id)->get();
    }

    /**
     * @inheritDoc
     */
    public function createSharedPetRequest(?string $description, string $expiration_date, int $pet_id, int $owner_id, int $professional_id): SharedPet
    {
        $sharedPetR = new SharedPet();

        $sharedPetR->accepted = false;
        $sharedPetR->description = $description;
        $sharedPetR->expiration_date = $expiration_date;
        $sharedPetR->pets_id = $pet_id;
        $sharedPetR->owners_id = $owner_id;
        $sharedPetR->professionals_id = $professional_id;
        $sharedPetR->created_at = now();
        $sharedPetR->updated_at = now();

        $sharedPetR->save();

        return $sharedPetR;
    }

    /**
     * @inheritDoc
     */
    public function updateSharedPetRequest(int $id, ?string $description, string $expiration_date, int $pet_id): SharedPet
    {
        $sharedPetR = SharedPet::find($id);

        $sharedPetR->description = $description;
        $sharedPetR->expiration_date = $expiration_date;
        $sharedPetR->pets_id = $pet_id;
        $sharedPetR->updated_at = now();

        $sharedPetR->save();

        return $sharedPetR;
    }

    /**
     * @inheritDoc
     */
    public function acceptSharedPetRequest(int $id)
    {
        $sharedPetR = SharedPet::find($id);

        $sharedPetR->accepted = true;

        $sharedPetR->save();

        return $sharedPetR;
    }

    /**
     * @inheritDoc
     */
    public function deleteSharedPetRequest(int $id): bool
    {
        SharedPet::find($id)->delete();

        return true;
    }
}
