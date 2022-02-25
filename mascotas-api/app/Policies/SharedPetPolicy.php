<?php

namespace App\Policies;

use App\Models\SharedPet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SharedPetPolicy
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
     * @param  \App\Models\SharedPet  $sharedPet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SharedPet $sharedPet)
    {
        //
    }

    /**
     * Determine whether the user can view shared pets from the perspective of a professional
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewProfessionalSharedPets(User $user)
    {
        return $user->is_professional;
    }

    /**
     * Determine whether the user can view shared pets from the perspective of an owner
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewOwnerSharedPets(User $user)
    {
        return !$user->is_professional;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return !$user->is_professional;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedPet  $sharedPet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SharedPet $sharedPet)
    {
        return !$user->is_professional
            && $user->id === $sharedPet->owners_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedPet  $sharedPet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SharedPet $sharedPet)
    {
        return $user->is_professional
            && $user->id === $sharedPet->professionals_id
            && $sharedPet->expiration_date >= now()->format("Y-m-d")
            && !$sharedPet->accepted;
    }

    /**
     * Determine whether the user can accept the request to share a pet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedPet  $sharedPet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function accept(User $user, SharedPet $sharedPet)
    {
        return $user->is_professional
            && $user->id === $sharedPet->professionals_id
            && $sharedPet->expiration_date >= now()->format("Y-m-d")
            && !$sharedPet->accepted;
    }


    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedPet  $sharedPet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SharedPet $sharedPet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedPet  $sharedPet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SharedPet $sharedPet)
    {
        //
    }
}
