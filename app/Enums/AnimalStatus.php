<?php

namespace App\Enums;

enum AnimalStatus:String

{
    case ADOPTED = 'adopted';
    case ADOPTABLE = 'adoptable';
    case IN_PROCESS = 'in_process';
}
