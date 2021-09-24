<?php

namespace App\Policies;

use App\Models\GradingSystem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GradingSystemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, GradingSystem $gradingSystem)
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
        // Users should only be able to create grading systems associated with
        // organizations that they are owners of, this should be handled in controllers.
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GradingSystem $gradingSystem)
    {
        // User can only update grading systems from their own organization.
        return $gradingSystem->organization->users->contains($user->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GradingSystem $gradingSystem)
    {
        // User can only delete grading systems from their own organization.
        return $gradingSystem->organization->users->contains($user->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GradingSystem $gradingSystem)
    {
        // User can only restore grading systems from their own organization.
        return $gradingSystem->organization->users->contains($user->id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GradingSystem $gradingSystem)
    {
        return false;
    }
}
