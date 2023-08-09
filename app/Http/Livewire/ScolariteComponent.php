<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Eleve;
use App\Models\Caisse;
use App\Models\Classe;
use App\Models\Periode;
use Livewire\Component;
use App\Models\Admission;
use App\Models\Tarification;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use App\Models\NiveauScolaire;
use App\Traits\BaseQueryEleve;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CategorieTarification;

class ScolariteComponent extends Component
{
    protected $paginationTheme = "bootstrap";
    public $currentPage = PAGELIST;
    use WithPagination, BaseQueryEleve;

    public $newFrais = [];
    public $newFraisScolaire = [];
    public $newReinscription = [];
    public $editFrais = [];
    public $showFrais = [];

    public $IdEleve;

    //Informations frais scolaires
    public $montantRestantFrais;
    public $fraisAverser;
    public $statutFrais;


    //Filtre classes par niveaux scolaires et tarifications par categories tarifications
    public $_classes;
    public $_tarifications;
    public $_periodes;

    public $niveauId;
    public $categorieId;
    public $categoriePeriodeId;

    //Variables à passer dans la vue Frais scolaire

    public $Show = [];
    public $showClasse;
    public $showSexe;
    public $showIdClasse;
    public $showNomEleve;
    public $showPrenomEleve;
    public $showIdEleve;
    public $showIdAnneeScolaire;
    public $showStatutEleve;

    public $Ancienneclasse;


    public $anneeScolaireParDefaut;

    //A inserer
    public $tarification_id;
    public $periode_id;
    public $fraisVerse;

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

        $niveaux = NiveauScolaire::all();
        $categoriestarifications = CategorieTarification::whereIn('id', [2])->get();

        $periodes = Periode::where('categorieperiode_id', 1)->get();
        $categorieTarifFraisScolaire = CategorieTarification::whereIn('id', [3, 4, 5, 6])->get();

        return view(
            'livewire.modules.caisses.scolarites.index',
            compact(
                "eleves",
                "classes",
                "anneesscolaires",
                "categories",
                "niveaux",
                "categoriestarifications",
                "categorieTarifFraisScolaire",
                "periodes"
            )
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListScolarite()
    {
        $this->currentPage = PAGELIST;
        $this->newReinscription = [];
    }

    public function goToshowReinscription($id)
    {
        $this->newReinscription = Eleve::find($id)->toArray();
        $this->Ancienneclasse = $this->newReinscription['id'];
        $this->sexe = $this->newReinscription['id'];
        $this->currentPage = PAGEREINSCRIPTION;
    }

    public function goToshowFrais($id)
    {
        $this->Show = Admission::find($id);
        $this->showIdEleve = $this->Show->eleve_id;
        $this->showIdClasse = $this->Show->classe_id;
        $this->showIdAnneeScolaire = $this->Show->anneesscolaire_id;

        $this->showClasse = $this->Show->classe->nom;
        $this->showNomEleve = $this->Show->eleve->nom;
        $this->showPrenomEleve = $this->Show->eleve->prenom;
        $this->showStatutEleve = $this->Show->statutAdmission;
        $this->currentPage = PAGEFRAISSCOLAIRE;
    }

    public function updatedNiveauId()
    {
        if ($this->niveauId) {
            $this->_classes =
                Classe::where('niveauxscolaires_id', $this->niveauId)->get();
        } else {
            $this->_classes = null;
        }
    }

    public function updatedCategorieId()
    {
        if ($this->categorieId) {
            $this->_tarifications =
                Tarification::where('categoriestarification_id', $this->categorieId)->get();
        } else {
            $this->_tarifications = null;
        }
    }

    protected $rulesAddFraisScolaire = [
        'tarification_id' => 'nullable',
        'fraisVerse' => 'required',
        'periode_id' => 'required'
    ];

    public function addFraisScolaire()
    {
        $validatedData = $this->validate($this->rulesAddFraisScolaire);
        $this->fraisAverser = Tarification::find($validatedData["tarification_id"]);
        $this->montantRestantFrais = $this->fraisAverser->prix - $validatedData["fraisVerse"];

        if ($this->fraisVerse == $this->fraisAverser['prix']) {
            $this->statutFrais = 1;
        } else {
            $this->statutFrais = 2;
        }

        if ($this->fraisVerse > $this->fraisAverser['prix']) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Le montant versé ne doit pas être superieur à la tarification! "]);
        } else {
            try {
                DB::beginTransaction();
                Caisse::create([
                    'eleve_id' => $this->showIdEleve,
                    'classe_id' => $this->showIdClasse,
                    'anneesscolaire_id' => $this->showIdAnneeScolaire,
                    'tarification_id' => $validatedData["tarification_id"],
                    'montantVerse' => $validatedData["fraisVerse"],
                    'montantRestant' => $this->montantRestantFrais,
                    'periode_id' => $validatedData["periode_id"],
                    // Etat = 1 : Entrées dans la caisse, 2 Dépenses
                    'etat' => 1,
                    'statut' => $this->statutFrais
                ]);

                DB::commit();
                $this->fraisAverser = "";
                $this->fraisVerse = "";
                $this->montantRestantFrais = "";
                $this->newFrais = [];
                $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'admission a été effectué avec succès!"]);
            } catch (Exception $e) {
                DB::rollback();
                Log::error($e->getMessage());
                dd($e->getMessage());
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "L'admission de l'élève n'a pas aboutie! "]);
            }
        }
    }

    public function addReinscription()
    {
        $validatedData = $this->validate($this->rulesReinscription);

        try {
            DB::beginTransaction();
            Admission::create($validatedData["newReinscription"]);

            Caisse::create([
                'eleve_id' => $validatedData["newReinscription"]["eleve_id"],
                'anneesscolaire_id' => $validatedData["newReinscription"]["anneesscolaire_id"],
                'tarification_id' => $validatedData["newReinscription"]["tarification_id"],
                'fraisVerse' => $this->fraisVerse,
                'montantRestant' => $this->montantRestant,
                // Etat = 1 : Entrées dans la caisse, 2 Dépenses
                'etat' => 1,
                //'statut' => $this->statut
            ]);

            DB::commit();
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'admission a été effectué avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            dd($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "L'admission de l'élève n'a pas aboutie! "]);
        }
    }
}
