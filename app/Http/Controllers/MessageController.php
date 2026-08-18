<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreMessageRequest;
use App\Mail\MessageReceivedMail;
use App\Mail\NewMessageMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request)
    {
        $message = Message::create($request->validated());

        Mail::to($message->email)->send(new MessageReceivedMail($message));

        $admins = User::where('role', UserRole::ADMIN)->get();
        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new NewMessageMail($message));
        }

        return back()->with('send', 'Votre message a été envoyé !');
    }
}
