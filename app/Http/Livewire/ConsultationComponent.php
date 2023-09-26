<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConsultationComponent extends Component
{
    public $currentPage = PAGELIST;

    public function render()
    {
        return view(
            'livewire.modules.acceuil.index'
        )
            ->extends("layouts.master")
            ->section("contenu");
    }
}
