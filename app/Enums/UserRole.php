<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case VOLUNTEER = 'volunteer';

    public function label(): string
    {
        return __('enums.user_role.'.$this->value);
    }
}
