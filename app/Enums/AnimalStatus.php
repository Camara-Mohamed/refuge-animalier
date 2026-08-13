<?php

namespace App\Enums;

enum AnimalStatus: string
{
    case PENDING = 'pending';
    case ADOPTABLE = 'adoptable';
    case UNDER_CARE = 'under_care';
    case IN_PROCESS = 'in_process';
    case ADOPTED = 'adopted';
    case DECEASED = 'deceased';

    public function label(): string
    {
        return __('enums.animal_status.'.$this->value);
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'bg-amber-100 text-amber-700',
            self::ADOPTABLE => 'bg-emerald-100 text-emerald-700',
            self::UNDER_CARE => 'bg-blue-turquoise/10 text-blue-turquoise',
            self::IN_PROCESS => 'bg-fuchsia-100 text-fuchsia-700',
            self::ADOPTED => 'bg-blue-strong/10 text-blue-strong',
            self::DECEASED => 'bg-gray-200 text-gray-600',
        };
    }
}
