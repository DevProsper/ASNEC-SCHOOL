<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;

class AnneeScolaireComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newScolaire = [];
    public $editScolaire = [];

    protected $messages = [
        'newScolaire.nom.required' => "l'année scolaire est obligatoire.",

        'editScolaire.nom.required' => "l'année scolaire est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $anneesscolaires = AnneeScolaire::latest()->paginate(10);

        return view('livewire.modules.administrations.anneesscolaires.index', compact("anneesscolaires"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListScolaire()
    {
        $this->currentPage = PAGELIST;
        $this->editScolaire = [];
    }

    public function goToAddScolaire()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditScolaire($id)
    {
        $this->editScolaire = AnneeScolaire::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editScolaire.nom' => 'required',
                'editScolaire.dateDebut' => 'required',
                'editScolaire.dateFin' => 'required'
            ];
        }

        return [
            'newScolaire.nom' => 'required',
            'newScolaire.dateDebut' => 'date',
            'newScolaire.dateFin' => 'date'
        ];
    }

    public function addScolaire()
    {
        $validationAttributes = $this->validate();

        AnneeScolaire::create($validationAttributes["newScolaire"]);

        $this->newScolaire = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'année scolaire créée avec succès!"]);
    }

    public function updateScolaire()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            AnneeScolaire::find($this->editScolaire["id"])->update($validationAttributes["editScolaire"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'année scolaire mise à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de l'année scolaire."]);
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

    public function deleteScolaire($id)
    {
        try {
            AnneeScolaire::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'année scolaire a été supprimée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cette année scolaire est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de l'année scolaire."]);
            }
        }
    }
}