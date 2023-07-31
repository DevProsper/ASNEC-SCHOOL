<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Eleve;
use App\Models\Classe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EleveComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newEleve = [];
    public $editEleve = [];

    public $search = "";

    protected $messages = [
        'newEleve.sexe.required' => "le champ sexe est obligatoire",
        'newEleve.nom.required' => "le champ nom est obligatoire",
        'newEleve.prenom.required' => "le champ prenom est obligatoire",
        'newEleve.dateNaissance.required' => "le champ date de naissance est obligatoire",
        'newEleve.sexeTiteur.required' => "le champ sexe est obligatoire",
        'newEleve.nomTiteur.required' => "le champ nom est obligatoire",
        'newEleve.prenomTiteur.required' => "le champ prenom est obligatoire",
        'newEleve.telephone1Titeur.required' => "le champ telephone1 est obligatoire",

        'editEleve.sexe.required' => "le champ sexe est obligatoire",
        'editEleve.nom.required' => "le champ nom est obligatoire",
        'editEleve.prenom.required' => "le champ prenom est obligatoire",
        'editEleve.dateNaissance.required' => "le champ date de naissance est obligatoire",
        'editEleve.sexeTiteur.required' => "le champ sexe est obligatoire",
        'editEleve.nomTiteur.required' => "le champ nom est obligatoire",
        'editEleve.prenomTiteur.required' => "le champ prenom est obligatoire",
        'editEleve.telephone1Titeur.required' => "le champ telephone1 est obligatoire",
    ];

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
        $classes = Classe::where('statut', 1)->orderBy('nom', 'asc')->get();

        return view(
            'livewire.modules.eleves.index',
            compact("eleves", "classes")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListEleve()
    {
        $this->currentPage = PAGELIST;
        $this->editEleve = [];
    }

    public function goToAddEleve()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditEleve($id)
    {
        $this->editEleve = Eleve::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editEleve.sexe' => "required",
                'editEleve.nom' => "required",
                'editEleve.prenom' => "required",
                'editEleve.telephone' => "nullable",
                'editEleve.dateNaissance' => "required",
                'editEleve.lieuNaissance' => "nullable",
                'editEleve.email' => "nullable",
                'editEleve.description' => "nullable",
                'editEleve.classe_id' => "required",

                'editEleve.nomTiteur' => "required",
                'editEleve.prenomTiteur' => "required",
                'editEleve.telephoneTiteur' => "required",
                'editEleve.professionTiteur' => "nullable",
                'editEleve.adresseTiteur' => "nullable",
                'editEleve.emailTiteur' => "nullable",
            ];
        }

        return [
            'newEleve.sexe' => "required",
            'newEleve.nom' => "required",
            'newEleve.prenom' => "required",
            'newEleve.telephone' => "nullable",
            'newEleve.dateNaissance' => "required",
            'newEleve.lieuNaissance' => "nullable",
            'newEleve.email' => "nullable",
            'newEleve.description' => "nullable",

            'newEleve.nomTiteur' => "required",
            'newEleve.prenomTiteur' => "required",
            'newEleve.telephoneTiteur' => "required",
            'newEleve.professionTiteur' => "nullable",
            'newEleve.adresseTiteur' => "nullable",
            'newEleve.emailTiteur' => "nullable",
            'newEleve.classe_id' => "required",
        ];
    }

    public function addEleve()
    {
        $validationAttributes = $this->validate();

        $validationAttributes["newEleve"]["dateNaissance"] =
            substr($validationAttributes["newEleve"]["dateNaissance"], 0, 10);

        //dd($validationAttributes["newEleve"]);
        try {
            DB::beginTransaction();
            Eleve::create($validationAttributes["newEleve"]);
            DB::commit();
            $this->newEleve = [];

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'élève a crée avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            dd($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création de l'élève."]);
        }
    }

    public function updateEleve()
    {
        $validationAttributes = $this->validate();
        try {
            Eleve::find($this->editEleve["id"])->update($validationAttributes["editEleve"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'élève a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de l'élève."]);
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de supprimer $nom de la liste. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "data_id" => $id
            ]
        ]]);
    }

    public function deleteEleve($id)
    {
        try {
            Eleve::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'élève a été supprimé avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cet élève est lié à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de l'élève."]);
            }
        }
    }
}
