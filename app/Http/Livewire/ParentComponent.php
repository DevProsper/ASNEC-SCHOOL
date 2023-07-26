<?php

namespace App\Http\Livewire;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\ParentEl;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParentComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newParent = [];
    public $newEleve = [];
    public $editParent = [];

    public $nom;
    public $prenom;
    public $sexe;
    public $telephone1;
    public $dateNaissance;
    public $lieuNaissance;
    public $email;
    public $classe_id;
    public $anneesscolaire_id;
    public $description;
    public $parent_id;

    public $nomTiteur;

    public $search = "";

    protected $messages = [
        'newParent.sexe.required' => "le champ sexe est obligatoire",
        'newParent.nom.required' => "le champ nom est obligatoire",
        'newParent.prenom.required' => "le champ prenom est obligatoire",
        'newParent.dateNaissance.required' => "le champ date de naissance est obligatoire",
        'newParent.sexe.required' => "le champ sexe est obligatoire",
        'newParent.nom.required' => "le champ nom est obligatoire",
        'newParent.prenom.required' => "le champ prenom est obligatoire",
        'newParent.telephone1.required' => "le champ telephone1 est obligatoire",

        'editParent.sexe.required' => "le champ sexe est obligatoire",
        'editParent.nom.required' => "le champ nom est obligatoire",
        'editParent.prenom.required' => "le champ prenom est obligatoire",
        'editParent.dateNaissance.required' => "le champ date de naissance est obligatoire",
        'editParent.sexe.required' => "le champ sexe est obligatoire",
        'editParent.nom.required' => "le champ nom est obligatoire",
        'editParent.prenom.required' => "le champ prenom est obligatoire",
        'editParent.telephone1.required' => "le champ telephone1 est obligatoire",

        'newEleve.sexe.required' => "le champ sexe est obligatoire",
        'newEleve.nom.required' => "le champ nom est obligatoire",
        'newEleve.prenom.required' => "le champ prenom est obligatoire",
        'newEleve.dateNaissance.required' => "le champ date de naissance est obligatoire",
        'newEleve.sexeTiteur.required' => "le champ sexe est obligatoire",
        'newEleve.nomTiteur.required' => "le champ nom est obligatoire",
        'newEleve.prenomTiteur.required' => "le champ prenom est obligatoire",
        'newEleve.telephone1Titeur.required' => "le champ telephone1 est obligatoire",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $parents = ParentEl::latest();
        $search = $this->search;

        if ($search) {
            $parents = $parents->where('nom', 'LIKE', '%' . $search . '%');
            $parents = $parents->orWhere("telephone1", "like", "%{$search}%");
        }
        $parents = $parents->withCount('eleves')->paginate(10);

        $classes = Classe::where('statut', 1)->orderBy('nom', 'asc')->get();
        $anneesscolaires = AnneeScolaire::where('defaut', 1)->orderBy('nom', 'asc')->get();

        return view(
            'livewire.modules.parents.index',
            compact("parents", "classes", "anneesscolaires")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListParent()
    {
        $this->currentPage = PAGELIST;
        $this->editParent = [];
        $this->newEleve = [];
    }

    public function goToAddParent()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditParent($id)
    {
        $this->editParent = ParentEl::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function goToAddEleveWithParent($id)
    {
        $parent = $this->newEleve['parent_id']['id'] = ParentEl::find($id)->toArray();
        $this->parent_id = $parent['id'];
        $this->nomTiteur = $parent['nom'] . " " . $parent['prenom'];
        $this->currentPage = PAGECREATEFORM_ELEVE;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editParent.sexe' => "required",
                'editParent.nom' => "required",
                'editParent.prenom' => "required",
                'editParent.telephone1' => "required",
                'editParent.telephone2' => "nullable",
                'editParent.relation' => "nullable",
                'editParent.telephone2' => "nullable",
                'editParent.profession' => "nullable",
                'editParent.adresse' => "nullable",
                'editParent.email' => "nullable"
            ];
        } else if ($this->currentPage == PAGECREATEFORM) {
            return [
                'newParent.sexe' => "required",
                'newParent.nom' => "required",
                'newParent.prenom' => "required",
                'newParent.telephone1' => "required",
                'newParent.telephone2' => "nullable",
                'newParent.relation' => "nullable",
                'newParent.telephone2' => "nullable",
                'newParent.profession' => "nullable",
                'newParent.adresse' => "nullable",
                'newParent.email' => "nullable"
            ];
        } else {
            return [
                'newEleve.sexe' => "nullable",
                'newEleve.nom' => "nullable",
                'newEleve.prenom' => "nullable",
                'newEleve.telephone1' => "nullable",
                'newEleve.dateNaissance' => "nullable",
                'newEleve.lieuNaissance' => "nullable",
                'newEleve.email' => "nullable",
                'newEleve.description' => "nullable"
            ];
        }
    }

    public function addEleve()
    {
        try {
            DB::beginTransaction();
            //Eleve::create($validationAttributes["newEleve"]);
            Eleve::create([
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'sexe' => $this->sexe,
                'telephone1' => $this->telephone1,
                'dateNaissance' => $this->dateNaissance,
                'lieuNaissance' => $this->lieuNaissance,
                'email' => $this->email,
                'classe_id' => $this->classe_id,
                'anneesscolaire_id' => $this->anneesscolaire_id,
                'description' => $this->description,
                'parent_id' => $this->parent_id
            ]);
            DB::commit();

            $this->nom = "";
            $this->prenom = "";
            $this->sexe = "";
            $this->telephone1 = "";
            $this->dateNaissance = "";
            $this->lieuNaissance = "";
            $this->email = "";
            $this->classe_id = "";
            $this->anneesscolaire_id = "";
            $this->description = "";
            $this->parent_id = "";

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le parent a crée avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création de l'élève! Veuillez remplir tous les champs."]);
        }
    }

    public function addParent()
    {
        $validationAttributes = $this->validate();

        try {
            DB::beginTransaction();
            ParentEl::create($validationAttributes["newParent"]);
            DB::commit();
            $this->newParent = [];

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le parent a crée avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            dd($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création du parent."]);
        }
    }

    public function updateParent()
    {
        $validationAttributes = $this->validate();
        try {
            ParentEl::find($this->editParent["id"])->update($validationAttributes["editParent"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le parent a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du parent."]);
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

    public function deleteParent($id)
    {
        try {
            ParentEl::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le parent a été supprimé avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Le parent est lié à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression du parent."]);
            }
        }
    }
}
