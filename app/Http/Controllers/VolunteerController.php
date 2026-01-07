<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;

class VolunteerController extends Controller{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        User::create($validated);

        return back()->with('send', 'Votre demande pour être bénévole a été envoyé !');
    }

    public function index(string $locale)
    {
        return view('public.volunteer');
    }
}
