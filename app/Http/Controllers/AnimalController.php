<?php

namespace App\Http\Controllers;

use App\Enums\AnimalStatus;
use App\Enums\Gender;
use App\Models\Animal;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $races = Race::all();
        $species = Specie::all();
        $coats = Coat::all();

        $search = $request->string('search')->trim()->toString();
        $race = $request->string('race')->toString();
        $specie = $request->string('species')->toString();
        $gender = Gender::tryFrom(strtolower($request->string('sexe')->toString()));

        $animals = Animal::query()
            ->where('status', AnimalStatus::ADOPTABLE)
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            }))
            ->when($gender, fn ($q) => $q->where('gender', $gender))
            ->when($race && $race !== 'all', fn ($q) => $q->whereHas('race', fn ($q) => $q->where('name', $race)))
            ->when($specie && $specie !== 'all', fn ($q) => $q->whereHas('specie', fn ($q) => $q->where('name', $specie)))
            ->with(['race', 'specie.vaccines'])
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        return view('public.animals.index', compact('animals', 'races', 'species', 'coats'));
    }

    public function show($locale, $animal)
    {
        $animal = Animal::with(['race', 'specie', 'coat'])->findOrFail($animal);

        $vaccines = $animal->specie->vaccines;

        return view('public.animals.show', compact('animal', 'vaccines'));
    }
}
