<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\NiveauScolaire;

class NiveauScolaireComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newNvScolaire = [];
    public $editNvScolaire = [];

    protected $messages = [
        'newNvScolaire.nom.required' => "le niveau scolaire est obligatoire.",

        'editNvScolaire.nom.required' => "le niveau scolaire est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $niveauxscolaires = NiveauScolaire::latest()->paginate(10);

        return view('livewire.modules.administrations.niveauxscolaires.index', compact("niveauxscolaires"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListNvScolaire()
    {
        $this->currentPage = PAGELIST;
        $this->editNvScolaire = [];
    }

    public function goToAddNvScolaire()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditNvScolaire($id)
    {
        $this->editNvScolaire = NiveauScolaire::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editNvScolaire.nom' => 'required',
                'editNvScolaire.ordre' => 'integer',
            ];
        }

        return [
            'newNvScolaire.nom' => 'required',
            'newNvScolaire.ordre' => 'integer',
        ];
    }

    public function addNvScolaire()
    {
        $validationAttributes = $this->validate();

        NiveauScolaire::create($validationAttributes["newNvScolaire"]);

        $this->newNvScolaire = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le niveau scolaire crée avec succès!"]);
    }

    public function updateNvScolaire()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            NiveauScolaire::find($this->editNvScolaire["id"])->update($validationAttributes["editNvScolaire"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le niveau scolaire mise à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du niveau scolaire."]);
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

    public function deleteNvScolaire($id)
    {
        try {
            NiveauScolaire::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le niveau scolaire a été supprimé avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Ce niveau scolaire est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression du niveau scolaire."]);
            }
        }
    }
}
