<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdopterRequest;
use App\Models\Adopter;
use App\Models\Animal;

class AdopterController extends Controller
{
    public function store($locale, StoreAdopterRequest $request, Animal $animal)
    {
        $adopter = Adopter::create([
            ...$request->validated(),
            'have_garden' => $request->boolean('have_garden'),
        ]);

        $adopter->adoption()->create([
            'message' => $adopter->message,
            'animal_id' => $animal->id,
        ]);

        return back()->with('send', 'Votre demande d\'adoption a été envoyée !');
    }
}
