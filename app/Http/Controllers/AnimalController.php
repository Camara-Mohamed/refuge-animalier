<?php

namespace App\Http\Controllers;

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;

class AnimalController extends Controller{
    public function index()
    {
        $races = Race::all();
        $species = Specie::all();
        $coats = Coat::all();
        $vaccines = Animal::with([
            'race',
            'specie.vaccines'
        ])->get();

        $animals = Animal::where('status', AnimalStatus::ADOPTABLE)
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        return view('public.animals.index', compact('animals', 'races', 'species', 'coats', 'vaccines'));
    }

    public function show($locale, $animal)
    {
        $animal = Animal::with(['race', 'specie', 'coat'])->findOrFail($animal);

        $vaccines = $animal->specie->vaccines;

        return view('public.animals.show', compact('animal', 'vaccines'));
    }

}
