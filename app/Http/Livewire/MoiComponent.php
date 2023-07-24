<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Moi;
use Livewire\Component;
use Livewire\WithPagination;

class MoiComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newMois = [];
    public $editMois = [];

    protected $messages = [
        'newMois.nom.required' => "Le mois est obligatoire.",

        'editMois.nom.required' => "Le mois est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $mois = Moi::latest()->paginate(10);

        return view('livewire.modules.administrations.mois.index', compact("mois"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListMois()
    {
        $this->currentPage = PAGELIST;
        $this->editMois = [];
    }

    public function goToAddMois()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditMois($id)
    {
        $this->editMois = Moi::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editMois.nom' => 'required'
            ];
        }

        return [
            'newMois.nom' => 'required'
        ];
    }

    public function addMois()
    {
        $validationAttributes = $this->validate();

        Moi::create($validationAttributes["newMois"]);

        $this->newMois = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le mois a été crée avec succès!"]);
    }

    public function updateMois()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            Moi::find($this->editMois["id"])->update($validationAttributes["editMois"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le mois a été mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour du mois."]);
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

    public function deleteMois($id)
    {
        try {
            Moi::destroy($id);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Le mois a été supprimé avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Ce mois est lié à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression du."]);
            }
        }
    }
}