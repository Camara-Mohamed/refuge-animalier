<?php

namespace App\Enums;

enum AdoptionStatus: string
{
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case QUEUE = 'queue';
    case SUBMITTED = 'submitted';
}
