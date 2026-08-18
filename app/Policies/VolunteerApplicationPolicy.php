<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VolunteerApplication;

class VolunteerApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VolunteerApplication $volunteerApplication): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VolunteerApplication $volunteerApplication): bool
    {
        return $user->isAdmin();
    }
}
