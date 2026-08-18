<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreVolunteerRequest;
use App\Mail\NewVolunteerApplicationMail;
use App\Mail\VolunteerApplicationReceivedMail;
use App\Models\User;
use App\Models\VolunteerApplication;
use Illuminate\Support\Facades\Mail;

class VolunteerController extends Controller
{
    public function store(StoreVolunteerRequest $request)
    {
        $application = VolunteerApplication::create($request->validated());

        Mail::to($application->email)->send(new VolunteerApplicationReceivedMail($application));

        $admins = User::where('role', UserRole::ADMIN)->where('receive_emails', true)->get();
        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new NewVolunteerApplicationMail($application));
        }

        return back()->with('send', 'Votre demande pour être bénévole a été envoyé !');
    }

    public function index(string $locale)
    {
        return view('public.volunteer');
    }
}
