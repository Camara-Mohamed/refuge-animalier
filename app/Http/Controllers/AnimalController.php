<?php

namespace App\Http\Controllers;

class AnimalController extends Controller{
    public function index()
    {
        return view('public.animals.index');
    }
}
