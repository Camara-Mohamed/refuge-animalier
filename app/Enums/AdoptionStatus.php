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
}
