<?php

namespace App\Policies;

use App\Cashflow;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashflowPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cashflow  $cashflow
     * @return mixed
     */
    public function view(User $user, Cashflow $cashflow)
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
        return $user->can('show finances');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cashflow  $cashflow
     * @return mixed
     */
    public function update(User $user, Cashflow $cashflow)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cashflow  $cashflow
     * @return mixed
     */
    public function delete(User $user, Cashflow $cashflow)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cashflow  $cashflow
     * @return mixed
     */
    public function restore(User $user, Cashflow $cashflow)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cashflow  $cashflow
     * @return mixed
     */
    public function forceDelete(User $user, Cashflow $cashflow)
    {
        //
    }
}
