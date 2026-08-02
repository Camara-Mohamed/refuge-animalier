<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVolunteerRequest;
use App\Models\User;

class VolunteerController extends Controller
{
    public function store(StoreVolunteerRequest $request)
    {
        User::create($request->validated());

        return back()->with('send', 'Votre demande pour être bénévole a été envoyé !');
    }

    public function index(string $locale)
    {
        return view('public.volunteer');
    }
}
