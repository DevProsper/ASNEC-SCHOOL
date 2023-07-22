<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Classe;
use Livewire\Component;
use App\Models\Tarification;
use Livewire\WithPagination;
use App\Models\NiveauScolaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClasseComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newClasse = [];
    public $editClasse = [];

    protected $messages = [
        'newClasse.nom.required' => "la classe est obligatoire.",
        'newClasse.niveauxscolaire_id.required' => "Le niveau scolaire est obligatoire.",
        'newClasse.tarification_id.required' => "la tarification est obligatoire.",

        'editClasse.nom.required' => "la classe est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $classes = Classe::latest()->paginate(10);
        $niveauxScolaires = NiveauScolaire::where('statut', 1)->orderBy('nom', 'asc')->get();
        $tarifications = Tarification::where('statut', 1)->orderBy('prix', 'asc')->get();

        return view(
            'livewire.modules.administrations.classes.index',
            compact("classes", "niveauxScolaires", "tarifications")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListClasse()
    {
        $this->currentPage = PAGELIST;
        $this->editClasse = [];
    }

    public function goToAddClasse()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditClasse($id)
    {
        $this->editClasse = Classe::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editClasse.nom' => 'required',
                'editClasse.acceuil' => 'integer',
                'editClasse.niveauxscolaire_id' => 'required',
                'editClasse.tarification_id' => 'required'
            ];
        }

        return [
            'newClasse.nom' => 'required',
            'newClasse.acceuil' => 'string',
            'newClasse.niveauxscolaire_id' => 'required',
            'newClasse.tarification_id' => 'required'
        ];
    }

    public function addClasse()
    {
        $validationAttributes = $this->validate();

        try {
            DB::beginTransaction();
            Classe::create($validationAttributes["newClasse"]);
            DB::commit();
            $this->newClasse = [];

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La classe a créée avec succès!"]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création de la classe."]);
        }
    }

    public function updateClasse()
    {
        $validationAttributes = $this->validate();
        try {
            Classe::find($this->editClasse["id"])->update($validationAttributes["editClasse"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La classe a été mise à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de la classe."]);
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

    public function deleteClasse($id)
    {
        try {
            Classe::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La classe a été supprimée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cette classe est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de la classe."]);
            }
        }
    }
}
