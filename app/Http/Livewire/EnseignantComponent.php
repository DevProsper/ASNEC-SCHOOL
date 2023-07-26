<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Diplome;
use Livewire\Component;
use App\Models\Enseignant;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnseignantComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newEnseignant = [];
    public $editEnseignant = [];

    protected $messages = [
        'newEnseignant.nom.required' => "le nom de l'enseignant est obligatoire.",
        'newEnseignant.prenom.required' => "le prenom de l'enseignant est obligatoire.",
        'newEnseignant.sexe.required' => "le sexe de l'enseignant est obligatoire.",
        'newEnseignant.diplome_id.required' => "le diplôme de l'enseignant est obligatoire.",
        'newEnseignant.telephone1.required' => "le numéro de téléphone 1 est obligatoire",

        'editEnseignant.nom.required' => "le nom de l'enseignant est obligatoire.",
        'editEnseignant.prenom.required' => "le prenom de l'enseignant est obligatoire.",
        'editEnseignant.sexe.required' => "le sexe de l'enseignant est obligatoire.",
        'editEnseignant.diplome_id.required' => "le diplôme de l'enseignant est obligatoire.",
        'editEnseignant.telephone1.required' => "le numéro de téléphone 1 est obligatoire",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $enseignants = Enseignant::latest()->paginate(10);
        $diplomes = Diplome::where('statut', 1)->orderBy('nom', 'asc')->get();

        return view(
            'livewire.modules.enseignants.index',
            compact("enseignants", "diplomes")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListEnseignant()
    {
        $this->currentPage = PAGELIST;
        $this->editEnseignant = [];
    }

    public function goToAddEnseignant()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToAddEleveWithParent()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditEnseignant($id)
    {
        $this->editEnseignant = Enseignant::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editEnseignant.nom' => 'required',
                'editEnseignant.sexe' => 'required',
                'editEnseignant.email' => 'nullable',
                'editEnseignant.diplome_id' => 'required',
                'editEnseignant.telephone1' => 'required',
                'editEnseignant.telephone2' => 'nullable',
                'editEnseignant.dateContrat' => 'nullable',
                'editEnseignant.typeContrat' => 'nullable',
                'editEnseignant.duree' => 'nullable',
                'editEnseignant.prenom' => 'required'
            ];
        }

        return [
            'newEnseignant.nom' => 'required',
            'newEnseignant.sexe' => 'required',
            'newEnseignant.email' => 'nullable',
            'newEnseignant.diplome_id' => 'required',
            'newEnseignant.telephone1' => 'required',
            'newEnseignant.telephone2' => 'nullable',
            'newEnseignant.dateContrat' => 'nullable',
            'newEnseignant.typeContrat' => 'nullable',
            'newEnseignant.duree' => 'nullable',
            'newEnseignant.prenom' => 'required'
        ];
    }

    public function addEnseignant()
    {
        $validationAttributes = $this->validate();

        try {
            DB::beginTransaction();
            Enseignant::create($validationAttributes["newEnseignant"]);
            DB::commit();
            $this->newEnseignant = [];

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'enseignant a été crée avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création de l'enseignant."]);
        }
    }

    public function updateEnseignant()
    {
        $validationAttributes = $this->validate();
        try {
            Enseignant::find($this->editEnseignant["id"])->update($validationAttributes["editEnseignant"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'enseignant a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de l'enseignant."]);
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

    public function deleteEnseignant($id)
    {
        try {
            Enseignant::destroy($id);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "l'enseignant a été supprimée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cet enseignant est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de l'enseignant."]);
            }
        }
    }
}
