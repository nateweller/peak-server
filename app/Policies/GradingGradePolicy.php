<?php

namespace App\Policies;

use App\Models\GradingGrade;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GradingGradePolicy
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
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, GradingGrade $gradingGrade)
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
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GradingGrade $gradingGrade)
    {
        // User can only update grading systems from their own organization.
        return $gradingGrade->gradingSystem->organization->users->contains($user->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GradingGrade $gradingGrade)
    {
        // User can only delete grading systems from their own organization.
        return $gradingGrade->gradingSystem->organization->users->contains($user->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GradingGrade $gradingGrade)
    {
        // User can only restore grading systems from their own organization.
        return $gradingGrade->gradingSystem->organization->users->contains($user->id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GradingGrade $gradingGrade)
    {
        return false;
    }
}
