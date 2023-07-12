<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UtilisateurComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newUser = [];
    public $editUser = [];

    public function render()
    {
        Carbon::setLocale("fr");
        $users = User::latest()->paginate(1);

        return view('livewire.modules.utilisateurs.index', compact('users'))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToAddClient()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditClient($id)
    {
        //$this->editClient = Client::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }



    public function goToListClient()
    {
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }
}
