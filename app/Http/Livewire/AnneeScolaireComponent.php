<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Traits\Loggable;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Auth;

class AnneeScolaireComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination, Loggable;
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

        // Utilisation du service pour insérer un log
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
                'editScolaire.dateDebut' => 'nullable',
                'editScolaire.dateFin' => 'nullable',
                'editScolaire.defaut' => 'nullable'
            ];
        }

        return [
            'newScolaire.nom' => 'required',
            'newScolaire.dateDebut' => 'nullable',
            'newScolaire.dateFin' => 'nullable',
            'newScolaire.defaut' => 'nullable'
        ];
    }

    public function addScolaire()
    {
        $validationAttributes = $this->validate();

        AnneeScolaire::create($validationAttributes["newScolaire"]);

        $this->newScolaire = [];

        $this->insertLog(Auth::id(), 'CREATION', "Ajout de l'année scolaire " . $validationAttributes["newScolaire"]["nom"]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'année scolaire créée avec succès!"]);
    }

    public function updateScolaire()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            AnneeScolaire::find($this->editScolaire["id"])->update($validationAttributes["editScolaire"]);
            $this->insertLog(Auth::id(), 'MODIFICATION', "Mise à jour de l'année scolaire " . $validationAttributes["editScolaire"]["nom"]);
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
            $annee = AnneeScolaire::find($id);
            $annee->destroy($annee->id);

            $this->insertLog(Auth::id(), 'SUPRESSION', "Supression de l'année scolaire " . $annee->nom);

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
