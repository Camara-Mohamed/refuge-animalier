<?php

namespace App\Enums;

enum AdoptionStatus: string
{
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case QUEUE = 'queue';
    case SUBMITTED = 'submitted';

    public function label(): string
    {
        return __('enums.adoption_status.'.$this->value);
    }

    public function color(): string
    {
        return match ($this) {
            self::SUBMITTED => 'bg-blue-turquoise/10 text-blue-turquoise',
            self::QUEUE => 'bg-amber-100 text-amber-700',
            self::ACCEPTED => 'bg-emerald-100 text-emerald-700',
            self::REJECTED => 'bg-gray-200 text-gray-600',
        };
    }
}
