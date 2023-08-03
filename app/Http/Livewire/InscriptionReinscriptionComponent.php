<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Eleve;
use App\Models\Caisse;
use App\Models\Classe;
use Livewire\Component;
use App\Models\Admission;
use App\Models\Tarification;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use App\Models\NiveauScolaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CategorieTarification;

class InscriptionReinscriptionComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newAdmission = [];
    public $editCaisse = [];
    public $showAdmission = [];

    public $IdEleve;
    public $defautEleve;

    public $montantVerse;
    public $montantRestant;
    public $montantAverser;

    public $search = "";

    public $niveauId;
    public $classes;
    public $annee_id;

    public $categorieId;
    public $tarifications;

    public $statutEleve = 2;

    public $statut; // 1-Terminé, 2-Accompte et etat = 1 Entrées, 2 Dépenses

    public function render()
    {
        Carbon::setLocale("fr");

        $eleves = Eleve::latest();
        $search = $this->search;

        if ($search) {
            $eleves = $eleves->where('nom', 'LIKE', '%' . $search . '%');
            $eleves = $eleves->orWhere("telephone", "like", "%{$search}%");
            $eleves = $eleves->orWhere("nomTiteur", "like", "%{$search}%");
            $eleves = $eleves->orWhere("telephoneTiteur", "like", "%{$search}%");
        }
        $eleves = $eleves->paginate(10);

        $niveaux = NiveauScolaire::all();
        $categoriestarifications = CategorieTarification::whereIn('id', [1, 2])->get();


        return view(
            'livewire.modules.caisses.index',
            compact("eleves", "niveaux", "categoriestarifications")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListCaisse()
    {
        $this->currentPage = PAGELIST;
        $this->editCaisse = [];
    }

    public function goToAddEleve()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToshowAdmission($id)
    {
        $this->newAdmission = Eleve::find($id)->toArray();
        $this->IdEleve = $this->newAdmission['id'];
        $this->defautEleve = $this->newAdmission;
        $this->currentPage = PAGECREATEADMISSION;
    }

    public function rules()
    {
        if ($this->currentPage == PAGECREATEADMISSION) {

            return [
                'newAdmission.eleve_id' => 'nullable',
                'newAdmission.tarification_id' => 'required',
                'newAdmission.classe_id' => 'required',
                'newAdmission.anneesscolaire_id' => 'nullable',
                'newAdmission.statutAdmission' => 'required'
            ];
        }
        return [
            'editAdmission.eleve_id' => 'nullable',
            'editAdmission.tarification_id' => 'required',
            'editAdmission.classe_id' => 'required',
            'editAdmission.anneesscolaire_id' => 'nullable',
            'editAdmission.statutAdmission' => 'required',
        ];
    }

    public function addAdmission()
    {
        $validationAttributes = $this->validate();
        $validationAttributes["newAdmission"]["eleve_id"] = $this->IdEleve;

        //On affiche l'année scolaire par défaut
        $anneesscolaires = AnneeScolaire::where('defaut', 1)->get();
        foreach ($anneesscolaires as $ann) {
            $this->annee_id = $ann->id;
        }

        $validationAttributes["newAdmission"]["anneesscolaire_id"] = $this->annee_id;

        $this->montantAverser = Tarification::find($validationAttributes["newAdmission"]["tarification_id"])->toArray();

        $this->montantRestant = $this->montantAverser['prix'] - $this->montantVerse;

        if ($this->montantAverser['prix'] == $this->montantVerse) {
            $this->statut = 1;
        } else if ($this->montantVerse < $this->montantAverser['prix']) {
            $this->statut = 2;
        } else {
            $this->statut = 3;
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Le montant verser est supérieur au montant à la tarification !"]);
        }

        try {
            DB::beginTransaction();
            Admission::create($validationAttributes["newAdmission"]);

            $eleve = Eleve::find($validationAttributes["newAdmission"]["eleve_id"]);
            $eleve->update([
                'defaut' => 2
            ]);

            Caisse::create([
                'eleve_id' => $validationAttributes["newAdmission"]["eleve_id"],
                'anneesscolaire_id' => $validationAttributes["newAdmission"]["anneesscolaire_id"],
                'tarification_id' => $validationAttributes["newAdmission"]["tarification_id"],
                'montantVerse' => $this->montantVerse,
                'montantRestant' => $this->montantRestant,
                // Etat = 1 : Entrées dans la caisse
                'etat' => 1,
                'statut' => $this->statut
            ]);

            DB::commit();
            $this->montantAverser = "";
            $this->montantVerse = "";
            $this->montantRestant = "";
            $this->newAdmission = [];
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'admission a été effectué avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            dd($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "L'admission de l'élève n'a pas aboutie! "]);
        }
    }

    public function updatedNiveauId()
    {
        if ($this->niveauId) {
            $this->classes =
                Classe::where('niveauxscolaires_id', $this->niveauId)->get();
        } else {
            $this->classes = null;
        }
    }

    public function updatedCategorieId()
    {
        if ($this->categorieId) {
            $this->tarifications =
                Tarification::where('categoriestarification_id', $this->categorieId)->get();
        } else {
            $this->tarifications = null;
        }
    }
}
