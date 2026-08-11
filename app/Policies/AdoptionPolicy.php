<?php

namespace App\Policies;

use App\Models\Adoption;
use App\Models\User;

class AdoptionPolicy
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
    public function view(User $user, Adoption $adoption): bool
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
    public function update(User $user, Adoption $adoption): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can change the adoption status
     * (pending -> in_process -> adopted / rejected).
     */
    public function changeStatus(User $user, Adoption $adoption): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Adoption $adoption): bool
    {
        return $user->isAdmin();
    }
}
