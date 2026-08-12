<?php

namespace App\Enums;

enum House: string
{
    case APARTMENT = 'apartment';
    case HOUSE = 'house';
    case LOFT = 'loft';
    case STUDIO = 'studio';

    public function label(): string
    {
        return __('enums.house.'.$this->value);
    }
}
