<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdopterRequest;
use App\Models\Adopter;
use App\Models\Animal;

class AdopterController extends Controller
{
    public function store($locale, StoreAdopterRequest $request, Animal $animal)
    {
        Adopter::create([
            ...$request->validated(),
            'have_garden' => $request->boolean('have_garden'),
        ]);

        return back()->with('send', 'Votre demande d\'adoption a été envoyé !');
    }
}
