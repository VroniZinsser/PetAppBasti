<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VaccinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Vaccine $vaccine
     * @return Response|bool
     */
    public function view(User $user, Vaccine $vaccine)
    {
        return $this->isPetOwner($user, $vaccine->pet);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Pet $pet
     * @return Response|bool
     */
    public function create(User $user, Pet $pet)
    {
        return !$user->is_professional && $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Vaccine $vaccine
     * @return Response|bool
     */
    public function update(User $user, Vaccine $vaccine)
    {
        return $this->isPetOwner($user, $vaccine->pet);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Vaccine $vaccine
     * @return Response|bool
     */
    public function delete(User $user, Vaccine $vaccine)
    {
        return $this->isPetOwner($user, $vaccine->pet);
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
}
