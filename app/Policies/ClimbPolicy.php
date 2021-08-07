<?php

namespace App\Policies;

use App\Models\Climb;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClimbPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Climb  $climb
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Climb $climb)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Climb  $climb
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Climb $climb)
    {
        // only the climb owner can update
        return $user->climbs->contains($climb->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Climb  $climb
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Climb $climb)
    {
        // only the climb owner can delete
        return $user->climbs->contains($climb->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Climb  $climb
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Climb $climb)
    {
        // only the climb owner can restore
        return $user->climbs->contains($climb->id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Climb  $climb
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Climb $climb)
    {
        // no - soft deletes only
        return false;
    }
}
