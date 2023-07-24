<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Classe;
use App\Models\Matiere;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class MatiereComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newMatiere = [];
    public $editMatiere = [];
    public $assignClasses = [];
    public $search = "";

    protected $messages = [
        'newMatiere.nom.required' => "La matière est obligatoire.",

        'editMatiere.password.min' => "La matière est obligatoire.",
    ];


    public function render()
    {
        Carbon::setLocale("fr");

        $matieres = Matiere::latest()->paginate(10);

        return view('livewire.modules.administrations.matieres.index', compact("matieres"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListMatiere()
    {
        $this->currentPage = PAGELIST;
        $this->editMatiere = [];
    }

    public function goToAddMatiere()
    {
        $this->currentPage = PAGECREATEFORM;

        //$this->populateAssignClasses();
    }

    public function goToEditMatiere($id)
    {
        $this->editMatiere = Matiere::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;

        $this->populateAssignClasses();
    }

    public function populateAssignClasses()
    {
        $this->assignClasses["classes"] = [];

        $mapForCB = function ($value) {
            return $value["id"];
        };

        $classeIds = array_map($mapForCB, Matiere::find($this->editMatiere["id"])->classes->toArray()); // [1, 2, 4]

        foreach (Classe::all() as $classe) {
            if (in_array($classe->id, $classeIds)) {
                array_push($this->assignClasses["classes"], ["classe_id" => $classe->id, "classe_nom" => $classe->nom, "active" => true]);
            } else {
                array_push($this->assignClasses["classes"], ["classe_id" => $classe->id, "classe_nom" => $classe->nom, "active" => false]);
            }
        }
    }

    public function updateMatieresAndClasses()
    {
        DB::table("matiere_classe")->where("matiere_id", $this->editMatiere["id"])->delete();

        foreach ($this->assignClasses["classes"] as $classe) {
            if ($classe["active"]) {
                Matiere::find($this->editMatiere["id"])->classes()->attach($classe["classe_id"]);
            }
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "la classe a été mis à jour avec succès!"]);
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editMatiere.nom' => 'required'
            ];
        }

        return [
            'newMatiere.nom' => 'required',
        ];
    }

    public function addMatiere()
    {
        $validationAttributes = $this->validate();

        Matiere::create($validationAttributes["newMatiere"]);

        $this->newMatiere = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Matière créée avec succès!"]);
    }

    public function updateMatiere()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            Matiere::find($this->editMatiere["id"])->update($validationAttributes["editMatiere"]);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La matière a été mise à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de la matière."]);
        }
    }

    public function confirmDelete($name, $id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des matières. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "data_id" => $id
            ]
        ]]);
    }

    public function deleteMatiere($id)
    {
        try {
            Matiere::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Matière supprimée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cette matière est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de la matière."]);
            }
        }
    }
}