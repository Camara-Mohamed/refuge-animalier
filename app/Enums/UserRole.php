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

    public function color(): string
    {
        return match ($this) {
            self::ADMIN => 'bg-red-strong/10 text-red-strong',
            self::VOLUNTEER => 'bg-blue-turquoise/10 text-blue-turquoise',
        };
    }
}
