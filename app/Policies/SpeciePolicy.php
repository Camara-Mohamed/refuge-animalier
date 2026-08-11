<?php

namespace App\Policies;

use App\Models\Specie;
use App\Models\User;

class SpeciePolicy
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
    public function view(User $user, Specie $specie): bool
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
    public function update(User $user, Specie $specie): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Specie $specie): bool
    {
        return $user->isAdmin();
    }
}
