<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Trimestre;
use Livewire\WithPagination;

class TrimestreComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newTrimestre = [];
    public $editTrimestre = [];

    protected $messages = [
        'newTrimestre.nom.required' => "le trimestre est obligatoire.",

        'editTrimestre.nom.required' => "le Trimestre est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $trimestres = Trimestre::latest()->paginate(10);

        return view('livewire.modules.administrations.trimestres.index', compact("trimestres"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListTrimestre()
    {
        $this->currentPage = PAGELIST;
        $this->editTrimestre = [];
    }

    public function goToAddTrimestre()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditTrimestre($id)
    {
        $this->editTrimestre = Trimestre::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editTrimestre.nom' => 'required',
            ];
        }

        return [
            'newTrimestre.nom' => 'required',
            'newTrimestre.dateDebut' => 'date',
            'newTrimestre.dateFin' => 'date'
        ];
    }

    public function addTrimestre()
    {
        $validationAttributes = $this->validate();

        Trimestre::create($validationAttributes["newTrimestre"]);

        $this->newTrimestre = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le trimestre a été crée avec succès!"]);
    }

    public function updateTrimestre()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            Trimestre::find($this->editTrimestre["id"])->update($validationAttributes["editTrimestre"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le trimestre a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du trimestre."]);
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

    public function deleteTrimestre($id)
    {
        try {
            Trimestre::destroy($id);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le trimestre a été supprimé avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Ce trimestre est lié à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression du trimestre."]);
            }
        }
    }
}