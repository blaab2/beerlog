<?php

namespace App\Policies;

use App\Beer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //return $user->can('show details');
        return 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beer  $beer
     * @return mixed
     */
    public function view(User $user, Beer $beer)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beer  $beer
     * @return mixed
     */
    public function update(User $user, Beer $beer)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beer  $beer
     * @return mixed
     */
    public function delete(User $user, Beer $beer)
    {
        return $user->can('show details');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beer  $beer
     * @return mixed
     */
    public function restore(User $user, Beer $beer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beer  $beer
     * @return mixed
     */
    public function forceDelete(User $user, Beer $beer)
    {
        //
    }
}
