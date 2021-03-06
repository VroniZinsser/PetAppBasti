<?php

namespace App\Services;

use App\Models\SharedPet;
use App\Models\User;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\Collection;

class ContactService implements ContactRepository
{

    /**
     * @inheritDoc
     */
    public function find(int $id): SharedPet
    {
        return SharedPet::find($id);
    }

    /**
     * @inheritDoc
     */
    public function getRequestsByProfessional(int $owner_id): Collection
    {
        $filterCurrentAccepted = function ($query) use($owner_id) {
            $query->whereDate('expiration_date', '>=', date('Y-m-d'))
                ->where('accepted', 1)
                ->where('owners_id', $owner_id);
        };
        $owner = User::find($owner_id);
        return $owner->relatedProfessionals()
            ->groupBy('id', 'first_name', 'last_name', 'owners_id', 'professionals_id')
            ->whereHas('requestsProfessional', $filterCurrentAccepted)
            ->with(['requestsProfessional' => $filterCurrentAccepted, 'requestsProfessional.pet', 'requestsProfessional.pet.image'])
            ->get();
    }

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
        $filterCurrentAccepted = function ($query) {
            $query->whereDate('expiration_date', '>=', date('Y-m-d'))->where('accepted', 1);
        };

        return SharedPet::where('professionals_id', $professional_id)
            ->where($filterCurrentAccepted)
            ->with(['pet', 'pet.image', 'owner'])
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function createSharedPetRequest(?string $description, string $expiration_date, int $pet_id, int $owner_id, int $professional_id): SharedPet
    {
        $request = new SharedPet();

        $request->accepted = false;
        $request->description = $description;
        $request->expiration_date = $expiration_date;
        $request->pets_id = $pet_id;
        $request->owners_id = $owner_id;
        $request->professionals_id = $professional_id;
        $request->created_at = now();
        $request->updated_at = now();

        $request->save();

        return $request;
    }

    /**
     * @inheritDoc
     */
    public function updateSharedPetRequest(SharedPet $request, ?string $description, string $expiration_date, int $pet_id): SharedPet
    {
        $request->description = $description;
        $request->expiration_date = $expiration_date;
        $request->pets_id = $pet_id;
        $request->updated_at = now();

        $request->save();

        return $request;
    }

    /**
     * @inheritDoc
     */
    public function acceptSharedPetRequest(SharedPet $request)
    {
        $request->accepted = true;

        $request->save();
    }

    /**
     * @inheritDoc
     */
    public function findSharedPetRequest(int $id)
    {
        return SharedPet::findOrFail($id)->load(['owner', 'pet']);
    }

    /**
     * @inheritDoc
     */
    public function deleteSharedPetRequest(SharedPet $request): bool
    {
        $request->delete();

        return true;
    }
}
