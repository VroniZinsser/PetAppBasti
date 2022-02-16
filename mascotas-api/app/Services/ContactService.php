<?php

namespace App\Services;

use App\Models\SharedPet;
use App\Models\User;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ContactService implements ContactRepository
{

    /**
     * @inheritDoc
     */
    public function getRequestsByProfessional(int $owner_id): Collection
    {
        $filterCurrentAccepted = function ($query) {
            $query->whereDate('expiration_date', '>=', date('Y-m-d'))->where('accepted', 1);
        };
        $owner = User::find($owner_id);
        $requestsByProfessionals = $owner->relatedProfessionals()
            ->groupBy('id', 'first_name', 'last_name', 'owners_id', 'professionals_id')
            ->whereHas('requestsProfessional', $filterCurrentAccepted)
            ->with(['requestsProfessional' => $filterCurrentAccepted,'requestsProfessional.pet', 'requestsProfessional.pet.image'])
            ->get();
        return $requestsByProfessionals;
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
        return SharedPet::where('professionals_id', $professional_id)->get();
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
    public function updateSharedPetRequest(int $id, ?string $description, string $expiration_date, int $pet_id): SharedPet
    {
        $request = SharedPet::find($id);

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
    public function acceptSharedPetRequest(int $id)
    {
        $request = SharedPet::find($id);

        $request->accepted = true;

        $request->save();

        return $request;
    }

    /**
     * @inheritDoc
     */
    public function checkAcceptRequest(int $id): bool
    {
        $request = $this->findSharedPetRequest($id);

        $user = \Auth::user();

        if (!$request || $user->id !== $request->professionals_id || $request->accepted || $request->expiration_date < now()->format("Y-m-d")) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function findSharedPetRequest(int $id)
    {
        try {
            $request = SharedPet::findOrFail($id);
        } catch (\Exception $exception) {
            return null;
        }

        $request->load(['owner', 'pet']);

        return $request;
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
