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
    public $periode_id = null;
    public $tarification_id;

    public $montantVerse;
    public $montantVerse2;
    public $montantRestant;
    public $montantRestantACouvri;
    public $statut;

    public $_classes;
    public $niveauId;

    public $categories;
    //Filtre quand la péiode quand la catégorie est égale à 
    public $periodesCategorie = [];
    public $selectedCategoryId = null;
    public $montantAverser;

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
                'tarification_id' => 'required',
                'classe_id' => 'required',
                'statutAdmission' => 'required',
                'montantVerse' => 'required',
                'montantVerse2' => 'nullable',
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
        $this->montantVerse = $this->editOperation->montantVerse;
        $this->montantVerse2 = $this->editOperation->montantVerse2;

        $tarification = Tarification::find($this->tarificationId);

        $this->categorieId = $tarification->categoriestarification_id;
        $this->tarification_id = $tarification->id;
        $this->periode_id = $this->editOperation->periode_id;

        $this->currentPage = PAGEEDITFORM;
    }

    public function goToAcompteOperation($id)
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
        $this->montantVerse = $this->editOperation->montantVerse;
        $this->montantVerse2 = $this->editOperation->montantVerse2;
        $this->montantRestantACouvri = $this->editOperation->montantRestant;

        $tarification = Tarification::find($this->tarificationId);

        $this->categorieId = $tarification->categoriestarification_id;
        $this->tarification_id = $tarification->id;
        $this->periode_id = $this->editOperation->periode_id;

        $this->currentPage = PAGEACOMPTE;
    }

    public function updateOperation()
    {
        //$this->validate();
        $this->montantVerse2 = $this->montantVerse2 ?: null;
        $this->periode_id = $this->periode_id ?: null;

        $this->montantAverser = Tarification::find($this->tarification_id)->toArray();

        $montantVerse = $this->montantVerse;
        $this->montantRestant = $this->montantAverser['prix'] - $montantVerse;

        if ($this->montantAverser['prix'] == $montantVerse) {
            $this->statut = 1; //Soldé
        } else {
            $this->statut = 2; //Acompte
        }
        if ($montantVerse < -1) {
            $this->dispatchBrowserEvent(
                "showErrorMessage",
                ["message" => "Le montant versé ne peut pas être inférieur à - 1 "]
            );
        }
        if ($montantVerse > $this->montantAverser['prix']) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Le montant versé ne doit pas être superieur à la tarification! "]);
        } else {
            try {
                Caisse::find($this->editOperation["id"])->update([
                    'tarification_id' => $this->tarification_id,
                    'periode_id' => $this->periode_id,
                    'montantVerse' => $montantVerse,
                    'admission_id'  => $this->admission_id,
                    'etat' => 1,
                    'montantVerse2' => null,
                    'montantRestant' => $this->montantRestant,
                    'statut' => $this->statut
                ]);
                Admission::find($this->admission_id)->update([
                    'classe_id' => $this->classe_id,
                    'statutAdmission' => $this->statutAdmission,
                ]);
                $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le parent a été mis à jour avec succès!"]);
            } catch (Exception $e) {
                dd($e->getMessage());
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du parent."]);
            }
        }
    }

    public function updateAcompteOperation()
    {
        //$this->validate();

        $this->montantAverser = Tarification::find($this->tarification_id)->toArray();

        $montantAVerser = $this->montantRestantACouvri;


        if ($montantAVerser > $this->montantVerse2) {
            $this->dispatchBrowserEvent(
                "showErrorMessage",
                ["message" => "Veuillez terminer votre dette qui coûte $montantAVerser FCFA !"]
            );
        } elseif ($montantAVerser < $this->montantVerse2) {
            $this->dispatchBrowserEvent(
                "showErrorMessage",
                ["message" => "Vous ne pouvez que verser $montantAVerser FCFA !"]
            );
        } else {
            $this->montantVerse += intval($this->montantVerse2);

            try {
                Caisse::find($this->editOperation["id"])->update([
                    'montantVerse' => $this->montantVerse,
                    'montantVerse2' => $this->montantVerse2,
                    'dateVersementReste'  => Carbon::now(),
                    'etat' => 1,
                    'statut' => 1,
                    'montantRestant' => 0
                ]);
                $this->dispatchBrowserEvent("showSuccessMessage", ["message" =>
                "Votre dette est entièrement réglé !"]);
            } catch (Exception $e) {
                dd($e->getMessage());
                $this->dispatchBrowserEvent("showErrorMessage", ["message" =>
                "Une erreur s'est produite lors du versement du montant."]);
            }
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de supprimer $nom de la liste. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer ?",
            "type" => "warning",
            "data" => [
                "data_id" => $id
            ]
        ]]);
    }

    public function deleteOperation($id)
    {
        try {
            Caisse::destroy($id);
            $this->dispatchBrowserEvent(
                "showSuccessMessage",
                ["message" => "l'opération a été supprimée avec succès!"]
            );
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent(
                    "showErrorMessage",
                    ["message" => "Impossible ! Cette opération est liée à d'autres données."]
                );
            } else {
                $this->dispatchBrowserEvent(
                    "showErrorMessage",
                    ["message" => "Une erreur s'est produite lors de la suppression de l'opération."]
                );
            }
        }
    }
}
