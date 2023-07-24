<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Tarification;
use Livewire\WithPagination;

class TarificationComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newTarification = [];
    public $editTarification = [];

    protected $messages = [
        'newTarification.nom.required' => "la tarification est obligatoire.",

        'editTarification.nom.required' => "la tarification est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $tarifications = Tarification::latest()->paginate(10);

        return view('livewire.modules.administrations.tarifications.index', compact("tarifications"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListTarification()
    {
        $this->currentPage = PAGELIST;
        $this->editTarification = [];
    }

    public function goToAddTarification()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditTarification($id)
    {
        $this->editTarification = Tarification::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editTarification.nom' => 'required',
                'editTarification.prix' => 'required'
            ];
        }

        return [
            'newTarification.nom' => 'required',
            'newTarification.prix' => 'required'
        ];
    }

    public function addTarification()
    {
        $validationAttributes = $this->validate();

        Tarification::create($validationAttributes["newTarification"]);

        $this->newTarification = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La tarification a été créée avec succès!"]);
    }

    public function updateTarification()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            Tarification::find($this->editTarification["id"])->update($validationAttributes["editTarification"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La tarification a été créée avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de la tarification."]);
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

    public function deleteTarification($id)
    {
        try {
            Tarification::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La tarification a été suppriméée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cette tarification est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de la tarification."]);
            }
        }
    }
}