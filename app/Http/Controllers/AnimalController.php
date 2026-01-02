<?php

namespace App\Http\Controllers;

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use App\Models\Vaccine;

class AnimalController extends Controller{
    public function index()
    {
        $races = Race::all();
        $species = Specie::all();
        $coats = Coat::all();
        $vaccines = Vaccine::all();

        $animals = Animal::where('status', AnimalStatus::ADOPTABLE)->get();

        return view('public.animals.index', compact('animals', 'races', 'species', 'coats', 'vaccines'));
    }
}
