<?php

namespace App\Http\Livewire;

use Exception;
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

    //Filtre classes par niveaux scolaires et tarifications par categories tarifications
    public $_classes;
    public $_tarifications;
    public $_periodes;

    public $niveauId;
    public $categorieId;
    public $categoriePeriodeId;

    //=================Variables à passer dans la vue Frais scolaire============
    public $Show = [];
    public $showClasse;

    public $showIdClasse;
    public $showNomEleve;
    public $showPrenomEleve;
    public $showIdEleve;
    public $showIdAnneeScolaire;
    public $showStatutEleve;
    //A inserer
    public $tarification_id;
    public $periode_id;
    public $fraisVerse;
    //Informations frais scolaires
    public $montantRestantFrais;
    public $fraisAverser;
    public $statutFrais;
    public $showIdScolaire;

    //Variables Réinscription
    public $showclasseEleveInscris;
    public $showSexeEleveInscris;
    public $showNomEleveInscris;
    public $showPrenomEleveInscris;
    public $showIdInscris;
    public $idAnneeParDefaut;

    public $R_montantVerse;
    public $R_montantAVerser;
    public $R_montantRestant;
    public $R_statut;
    public $IdEleveInscris;


    public $anneeScolaireParDefaut;

    protected $messages = [
        'newReinscription.tarification_id.required' => "Veuillez choisir la tarification.",
        'newReinscription.classe_id.required' => "Veuillez choisir la classe",
        'newReinscription.statutAdmission.required' => "Veuillez choisir le statut de l'élève.",
        'categorieId.required' => "Veuillez choisir la catégorie de la tarification.",
        'newReinscription.montantVerse' => "Le montant versé ne peut pas être vide !.",
    ];

    public function mount()
    {
        $this->rafraishir();
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

    public function rafraishir()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaire = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;

        //On initialise le total des filles et garçon à zéro
        $this->totalFilles = 0;
        $this->totalGarcons = 0;
    }

    public function goToListScolarite()
    {
        $this->currentPage = PAGELIST;

        $this->showIdEleve = "";
        $this->showIdClasse = "";
        $this->showIdAnneeScolaire = "";

        $this->showClasse = "";
        $this->showNomEleve = "";
        $this->showPrenomEleve = "";
        $this->showStatutEleve = "";

        $this->tarification_id = "";
        $this->categorieId = "";
        $this->fraisAverser = "";
        $this->periode_id = "";
        $this->fraisVerse = "";
    }


    public function goToshowReinscription($id)
    {
        $this->newReinscription = Admission::find($id);
        $this->showIdInscris = $this->newReinscription->id;
        $this->IdEleveInscris = $this->newReinscription->eleve_id;
        $this->showclasseEleveInscris = $this->newReinscription->classe->nom;
        $this->showSexeEleveInscris = $this->newReinscription->eleve->sexe;
        $this->showNomEleveInscris = $this->newReinscription->eleve->nom;
        $this->showPrenomEleveInscris = $this->newReinscription->eleve->prenom;
        $this->currentPage = PAGEREINSCRIPTION;
    }

    public function goToshowFrais($id)
    {
        $this->Show = Admission::find($id);
        $this->showIdScolaire = $this->Show->id;
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

    public function rules()
    {
        if ($this->currentPage == PAGEFRAISSCOLAIRE) {

            return [
                'tarification_id' => 'nullable',
                'fraisVerse' => 'required',
                'periode_id' => 'required'
            ];
        }
        return [
            'newReinscription.eleve_id' => 'nullable',
            'newReinscription.tarification_id' => 'required',
            'newReinscription.classe_id' => 'required',
            'newReinscription.anneesscolaire_id' => 'nullable',
            'newReinscription.statutAdmission' => 'required',
            'newReinscription.montantVerse' => 'required'
        ];
    }

    public function addFraisScolaire()
    {
        $validatedData = $this->validate();
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
                    'admission_id' => $this->showIdScolaire,
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

                $this->showIdEleve = "";
                $this->showIdClasse = "";
                $this->showIdAnneeScolaire = "";

                $this->showClasse = "";
                $this->showNomEleve = "";
                $this->showPrenomEleve = "";
                $this->showStatutEleve = "";

                $this->fraisAverser = "";
                $this->fraisVerse = "";
                $this->montantRestantFrais = "";
                $this->newFrais = [];
                $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le paiement a été effectué avec succès!"]);
            } catch (Exception $e) {
                DB::rollback();
                Log::error($e->getMessage());
                dd($e->getMessage());
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Le paiement n'a pas aboutie! "]);
            }
        }
    }

    public function AddReinscription()
    {
        $validationAttributes = $this->validate();

        //On affiche l'année scolaire par défaut
        $anneesscolaires = AnneeScolaire::where('defaut', 1)->get();
        foreach ($anneesscolaires as $ann) {
            $this->idAnneeParDefaut = $ann->id;
        }

        $validationAttributes["newReinscription"]["anneesscolaire_id"] = $this->idAnneeParDefaut;

        $this->R_montantAVerser = Tarification::find($validationAttributes["newReinscription"]["tarification_id"]);
        $this->R_montantVerse = $validationAttributes["newReinscription"]["montantVerse"];
        $this->R_montantRestant = $this->R_montantAVerser->prix - $this->R_montantVerse;

        if ($this->R_montantAVerser->prix == $this->R_montantVerse) {
            $this->R_statut = 1;
        } else {
            $this->R_statut = 2;
        }
        if ($this->R_montantVerse > $this->R_montantAVerser->prix) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Le montant versé ne doit pas être superieur à la tarification! "]);
        } else {
            try {
                DB::beginTransaction();
                Admission::create($validationAttributes["newReinscription"]);

                Caisse::create([
                    'admission_id' => $this->showIdInscris,
                    'eleve_id' => $this->IdEleveInscris,
                    'anneesscolaire_id' => $validationAttributes["newReinscription"]["anneesscolaire_id"],
                    'tarification_id' => $validationAttributes["newReinscription"]["tarification_id"],
                    'montantVerse' => $this->R_montantVerse,
                    'montantRestant' => $this->R_montantRestant,
                    // Etat = 1 : Entrées dans la caisse
                    'etat' => 1,
                    'statut' => $this->R_statut
                ]);

                DB::commit();
                $this->R_montantAVerser = "";
                $this->R_montantVerse = "";
                $this->R_montantRestant = "";
                $this->R_statut = "";
                $this->newReinscription = [];
                $this->IdEleveInscris = "";
                $this->showclasseEleveInscris = "";
                $this->showSexeEleveInscris = "";
                $this->showNomEleveInscris = "";
                $this->showPrenomEleveInscris = "";
                $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le paiement a été effectué avec succés !"]);
            } catch (Exception $e) {
                DB::rollback();
                Log::error($e->getMessage());
                dd($e->getMessage());
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Le paiement n'a pas abouti ! "]);
            }
        }
    }
}
