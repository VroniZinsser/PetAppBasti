<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Pet $pet
     * @return Response|bool
     */
    public function view(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet) || $this->petIsShared($user, $pet);
    }

    /**
     * Determine whether the user can view the medical details of the pet.
     *
     * @param User $user
     * @param Pet $pet
     * @return Response|bool
     */
    public function viewMedicalDetails(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet) || $this->petIsShared($user, $pet);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->is_professional
            ? Response::deny('Estás logueado como usuario profesional. Para agregar una mascota necesitás registrarte como usuario común.')
            : Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Pet $pet
     * @return Response|bool
     */
    public function update(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can update or delete the observation of a pet.
     *
     * @param User $user
     * @param Pet $pet
     * @return Response|bool
     */
    public function updateOrDeleteObservation(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Pet $pet
     * @return Response|bool
     */
    public function delete(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user is owner of the pet
     *
     * @param User $user
     * @param Pet $pet
     * @return bool
     */
    private function isPetOwner(User $user, Pet $pet): bool
    {
        foreach ($pet->owners as $owner) {
            if ($owner->id === $user->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the pet is shared with this user
     *
     * @param User $user
     * @param Pet $pet
     * @return bool
     */
    private function petIsShared(User $user, Pet $pet): bool
    {
        foreach ($pet->shareRequests as $request) {
            if ($request->professionals_id === $user->id
                && $request->accepted
                && $request->expiration_date >= now()->format("Y-m-d")) {
                    return true;
                }
        }

        return false;
    }
}
