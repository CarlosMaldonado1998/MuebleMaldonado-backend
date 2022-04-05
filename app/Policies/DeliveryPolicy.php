<?php

namespace App\Policies;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability){
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }

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
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Delivery $delivery)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Delivery $delivery)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Delivery $delivery)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Delivery $delivery)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }
}
