<?php

namespace App\Http\Controllers;

use App\Models\Adopter;
use App\Models\Animal;
use Illuminate\Http\Request;

class AdopterController extends Controller
{
    public function store($locale, Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'required|string',
            'address'      => 'required|string',
            'number'       => 'required|string',
            'city'         => 'required|string',
            'postal_code'  => 'required|string',
            'house_type'   => 'required',
            'have_garden'  => 'nullable|boolean',
            'message'      => 'required|string',
        ]);

        Adopter::create([
            ...$validated,
            'have_garden' => $request->boolean('have_garden'),
        ]);


        return back()->with('send', 'Votre demande d\'adoption a été envoyé !');
    }
}
