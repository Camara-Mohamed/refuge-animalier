<?php

namespace App\Enums;

enum AnimalStatus: string
{
    case ADOPTED = 'adopted';
    case ADOPTABLE = 'adoptable';
    case IN_PROCESS = 'in_process';
}
