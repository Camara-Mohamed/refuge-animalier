<?php

namespace App\Policies;

use App\Models\Coat;
use App\Models\User;

class CoatPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isVolunteer();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Coat $coat): bool
    {
        return $user->isAdmin() || $user->isVolunteer();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isVolunteer();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Coat $coat): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Coat $coat): bool
    {
        return $user->isAdmin();
    }
}
