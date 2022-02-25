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
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can view the medical details of the pet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewMedicalDetails(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
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
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can update or delete the observation of a pet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateOrDeleteObservation(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pet $pet)
    {
        return $this->isPetOwner($user, $pet);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Pet $pet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Pet $pet)
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
    private function isPetOwner(User $user, Pet $pet) {
        foreach ($pet->owners as $owner) {
            if ($owner->id === $user->id) {
                return true;
            }
        }

        return false;
    }
}
