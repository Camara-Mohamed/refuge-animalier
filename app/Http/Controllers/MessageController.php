<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request)
    {
        Message::create($request->validated());

        return back()->with('send', 'Votre message a été envoyé !');
    }
}
