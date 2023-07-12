<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UtilisateurComponent extends Component
{
    public $message = "Mon message";
    public function index()
    {
        $message = $this->message;
        return view('livewire.modules.utilisateurs.index', compact("message"));
    }
}
