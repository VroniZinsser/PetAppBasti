<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;
use App\Models\Weight;
use Illuminate\Auth\Access\HandlesAuthorization;

class WeightPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Weight $weight)
    {
        return $this->isPetOwner($user, $weight->pet);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Weight $weight)
    {
        return $this->isPetOwner($user, $weight->pet);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Weight $weight)
    {
        return $this->isPetOwner($user, $weight->pet);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Weight $weight)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Weight $weight)
    {
        //
    }

    /**
     * Determine whether the user is owner of the pet
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return bool
     */
    private function isPetOwner(User $user, Pet $pet)
    {
        foreach ($pet->owners as $owner) {
            if ($owner->id === $user->id) {
                return true;
            }
        }

        return false;
    }
}
