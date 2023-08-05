<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use App\Traits\BaseQueryEleve;
use App\Models\CategorieTarification;

class ScolariteComponent extends Component
{
    protected $paginationTheme = "bootstrap";
    public $currentPage = PAGELIST;
    use WithPagination, BaseQueryEleve;

    public $newFrais = [];
    public $editFrais = [];
    public $showFrais = [];

    public $IdEleve;

    //Informations frais scolaires
    public $montantVerse;
    public $montantRestant;
    public $montantAverser;

    public $niveauId;
    public $annee_id;

    public $categorieId;
    public $tarifications;

    public $anneeScolaireParDefaut;

    public function mount()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaire = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;

        //On initialise le total des filles et garçon à zéro
        $this->totalFilles = 0;
        $this->totalGarcons = 0;
    }

    public function render()
    {
        $eleves = $this->listeEleveParClasseAnneeSexe();
        $anneesscolaires = AnneeScolaire::all();
        $classes = Classe::all();
        $categories = CategorieTarification::whereIn('id', [1, 2])->get();

        return view(
            'livewire.modules.caisses.scolarites.index',
            compact(
                "eleves",
                "classes",
                "anneesscolaires",
                "categories"
            )
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListCaisse()
    {
        $this->currentPage = PAGELIST;
    }

    public function goToAddEleve()
    {
        $this->currentPage = PAGECREATEFORM;
    }
}
