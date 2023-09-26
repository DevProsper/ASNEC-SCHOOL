<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceuilController extends Controller
{
    public function index()
    {
        return view("livewire.modules.home.index");
    }
}
