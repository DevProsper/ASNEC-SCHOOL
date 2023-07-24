<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Batiment;
use Livewire\WithPagination;

class BatimentComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newBatiment = [];
    public $editBatiment = [];

    protected $messages = [
        'newBatiment.nom.required' => "l'année scolaire est obligatoire.",

        'editBatiment.nom.required' => "l'année scolaire est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");
        $batiments = Batiment::latest()->paginate(10);
        return view('livewire.modules.administrations.batiments.index', compact("batiments"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListBatiment()
    {
        $this->currentPage = PAGELIST;
        $this->editBatiment = [];
    }

    public function goToAddBatiment()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditBatiment($id)
    {
        $this->editBatiment = Batiment::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editBatiment.nom' => 'required',
            ];
        }

        return [
            'newBatiment.nom' => 'required',
        ];
    }

    public function addBatiment()
    {
        $validationAttributes = $this->validate();

        Batiment::create($validationAttributes["newBatiment"]);

        $this->newBatiment = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le batiment a été crée avec succès!"]);
    }

    public function updateBatiment()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            Batiment::find($this->editBatiment["id"])->update($validationAttributes["editBatiment"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le batiment a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du batiment."]);
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

    public function deleteBatiment($id)
    {
        try {
            Batiment::destroy($id);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le batiment a été supprimée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Ce batiment est lié à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression du batiment !"]);
            }
        }
    }
}