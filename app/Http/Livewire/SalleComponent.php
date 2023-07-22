<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Salle;
use Livewire\Component;
use App\Models\Batiment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalleComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newSalle = [];
    public $editSalle = [];

    protected $messages = [
        'newSalle.nom.required' => "la salle est obligatoire.",
        'newSalle.batiment_id.required' => "Le batiment est obligatoire.",

        'editSalle.nom.required' => "la salle est obligatoire.",
        'editSalle.batiment_id.required' => "Le batiment est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $salles = Salle::latest()->paginate(10);
        $batiments = Batiment::where('statut', 1)->orderBy('nom', 'asc')->get();

        return view(
            'livewire.modules.administrations.salles.index',
            compact("salles", "batiments")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListSalle()
    {
        $this->currentPage = PAGELIST;
        $this->editSalle = [];
    }

    public function goToAddSalle()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditSalle($id)
    {
        $this->editSalle = Salle::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editSalle.nom' => 'required',
                'editSalle.batiment_id' => 'required'
            ];
        }

        return [
            'newSalle.nom' => 'required',
            'newSalle.batiment_id' => 'required',
        ];
    }

    public function addSalle()
    {
        $validationAttributes = $this->validate();

        try {
            DB::beginTransaction();
            Salle::create($validationAttributes["newSalle"]);
            DB::commit();
            $this->newSalle = [];

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La salle a été créée avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création de la salle."]);
        }
    }

    public function updateSalle()
    {
        $validationAttributes = $this->validate();
        try {
            Salle::find($this->editSalle["id"])->update($validationAttributes["editSalle"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La salle a été mise à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de la salle."]);
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

    public function deleteSalle($id)
    {
        try {
            Salle::destroy($id);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "la salle a été supprimée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cette salle est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de la salle."]);
            }
        }
    }
}
