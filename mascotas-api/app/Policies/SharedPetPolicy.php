<?php

namespace App\Policies;

use App\Models\SharedPet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SharedPetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view shared pets from the perspective of a professional
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewProfessionalSharedPets(User $user)
    {
        return $user->is_professional;
    }

    /**
     * Determine whether the user can view shared pets from the perspective of an owner
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewOwnerSharedPets(User $user)
    {
        return !$user->is_professional;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return !$user->is_professional;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param SharedPet $sharedPet
     * @return Response|bool
     */
    public function update(User $user, SharedPet $sharedPet)
    {
        return !$user->is_professional
            && $user->id === $sharedPet->owners_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param SharedPet $sharedPet
     * @return Response|bool
     */
    public function delete(User $user, SharedPet $sharedPet)
    {
        $authorizedProfessional = $user->is_professional && $user->id === $sharedPet->professionals_id;
        $authorizedOwner = !$user->is_professional && $user->id === $sharedPet->owners_id;
        $requestValid = $sharedPet->expiration_date >= now()->format("Y-m-d");

        // Professionals can only remove requests that are not accepted already
        if ($authorizedProfessional && $requestValid && !$sharedPet->accepted) {
            return true;
        } elseif($authorizedOwner && $requestValid) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can accept the request to share a pet.
     *
     * @param User $user
     * @param SharedPet $sharedPet
     * @return Response|bool
     */
    public function accept(User $user, SharedPet $sharedPet)
    {
        return $user->is_professional
            && $user->id === $sharedPet->professionals_id
            && $sharedPet->expiration_date >= now()->format("Y-m-d")
            && !$sharedPet->accepted;
    }
}
