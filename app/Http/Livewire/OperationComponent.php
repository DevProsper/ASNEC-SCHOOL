<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Caisse;
use App\Models\Classe;
use App\Models\Periode;
use Livewire\Component;
use App\Models\Admission;
use App\Models\Tarification;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use App\Models\NiveauScolaire;
use App\Models\CategorieTarification;

class OperationComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;

    public $periode_id;
    public $anneescolaire_id;

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

    public $categorieId;
    public $_tarifications;

    public $tarificationId;
    public $classe_id;
    public $niveau_id;
    public $statutAdmission;
    public $admission_id;
    public $tarification_id;

    public $_classes;
    public $niveauId;

    public $categories;
    //Filtre quand la péiode quand la catégorie est égale à 
    public $periodesCategorie = [];
    public $selectedCategoryId = null;

    public function mount()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaire = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;

        $this->categories = CategorieTarification::all();
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

        //FILTRE
        $anneesscolaires = AnneeScolaire::all();
        $classes = Classe::where('statut', 1)->get();

        $this->_tarifications = Tarification::where('categoriestarification_id', $this->categorieId)
            ->where('statut', 1)
            ->get();

        return view(
            'livewire.modules.operations.index',
            compact(
                'operations',
                'periodes',
                'anneesscolaires',
                'classes'
            )
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'eleve_id' => 'nullable',
                'tarification_id' => 'required',
                'classe_id' => 'required',
                'anneesscolaire_id' => 'nullable',
                'statutAdmission' => 'required',
                'montantVerse' => 'required',
                'montantVerse2' => 'nullable',
                'periode_id' => 'nullable',
            ];
        }
        return [];
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
        $this->admission_id = $this->editOperation->admission_id;
        $admission = Admission::find($this->admission_id);
        $this->statutAdmission = $admission->statutAdmission;
        $classeId = $admission->classe_id;
        $classe = Classe::find($classeId);
        $this->classe_id = $classe->id;
        $this->tarificationId = $this->editOperation->tarification_id;

        $tarification = Tarification::find($this->tarificationId);

        $this->categorieId = $tarification->categoriestarification_id;
        $this->tarification_id = $tarification->id;
        $this->periode_id = $this->editOperation->periode_id;

        $this->currentPage = PAGEEDITFORM;
    }

    public function updateOperation()
    {
        $validationAttributes = $this->validate();
        try {
            Caisse::find($this->editOperation["id"])->update($validationAttributes["editOperation"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le parent a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du parent."]);
        }
    }
}
