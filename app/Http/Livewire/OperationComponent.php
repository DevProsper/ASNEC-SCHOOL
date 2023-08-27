<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Caisse;
use App\Models\Classe;
use App\Models\Periode;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use App\Models\CategorieTarification;

class OperationComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;

    public $periode_id;
    public $anneescolaire_id;
    public $statut;

    public $editOperation = [];

    public $statutFilter = '';
    public $periodeFilter = '';

    public $nomComplet = "";
    public $classeEleve = "";
    public $annee_scolaire = "";

    public $anneeScolaireParDefaut;
    public $anneeScolaire;
    public $categorieTarificationFilter = '';
    public $classeId;

    public function mount()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaire = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;
    }

    public function render()
    {
        Carbon::setLocale("fr");

        $query = Caisse::latest();

        if ($this->statutFilter) {
            $query->where('statut', $this->statutFilter);
        }

        if ($this->periodeFilter) {
            $query->where('periode_id', $this->periodeFilter);
        }

        if ($this->anneeScolaire) {
            $query->where('anneesscolaire_id', $this->anneeScolaire);
        }

        if ($this->categorieTarificationFilter) {
            $query->whereHas('tarification', function ($query) {
                $query->where('categoriestarification_id', $this->categorieTarificationFilter);
            });
        }

        if ($this->classeId) {
            $query->whereHas('admission', function ($query) {
                $query->where('classe_id', $this->classeId);
            });
        }

        $operations = $query->paginate(50);
        $periodes = Periode::where('categorieperiode_id', 1)->get();
        $anneesscolaires = AnneeScolaire::all();
        $categoriesTarification = CategorieTarification::all();
        $classes = Classe::all();

        return view(
            'livewire.modules.operations.index',
            compact(
                'operations',
                'periodes',
                'anneesscolaires',
                'categoriesTarification',
                'classes'
            )
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListOperation()
    {
        $this->currentPage = PAGELIST;
    }

    public function goToEditOperation($id)
    {
        $this->editOperation = Caisse::find($id);
        $this->nomComplet = $this->editOperation->admission->eleve->nom . " " . $this->editOperation->admission->eleve->prenom;
        $this->classeEleve = $this->editOperation->admission->classe->nom;
        $this->annee_scolaire = $this->editOperation->admission->anneesscolaire->nom;
        $this->currentPage = PAGEEDITFORM;
    }

    /*public function updateOperation()
    {
        $validationAttributes = $this->validate();
        try {
            ParentEl::find($this->editOperation["id"])->update($validationAttributes["editOperation"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le parent a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du parent."]);
        }
    }*/
}
