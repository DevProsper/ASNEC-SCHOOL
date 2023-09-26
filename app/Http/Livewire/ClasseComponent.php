<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Classe;
use Livewire\Component;
use App\Models\GroupeClasse;
use Livewire\WithPagination;
use App\Models\NiveauScolaire;
use App\Traits\Loggable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ClasseComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination, Loggable;
    public $newClasse = [];
    public $editClasse = [];

    public $niveauScolaireId;

    protected $messages = [
        'newClasse.nom.required' => "la classe est obligatoire.",
        'newClasse.niveauxscolaires_id.required' => "Le niveau scolaire est obligatoire.",
        'newClasse.tarification_id.required' => "la tarification est obligatoire.",

        'editClasse.nom.required' => "la classe est obligatoire.",
        'editClasse.niveauxscolaires_id.required' => "Le niveau scolaire est obligatoire.",
        'editClasse.tarification_id.required' => "la tarification est obligatoire.",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $classes = Classe::query();

        if ($this->niveauScolaireId) {
            $classes->where('niveauxscolaires_id', $this->niveauScolaireId);
        }

        $classes = $classes->paginate(10);


        $niveauxScolaires = NiveauScolaire::orderBy('nom', 'asc')->get();
        $groupes = GroupeClasse::orderBy('nom', 'asc')->get();

        return view(
            'livewire.modules.administrations.classes.index',
            compact(
                "classes",
                "niveauxScolaires",
                'groupes'
            )
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
                'editClasse.niveauxscolaires_id' => 'required',
                'editClasse.groupe_classe_id' => 'nullable',
            ];
        }

        return [
            'newClasse.nom' => 'required',
            'newClasse.niveauxscolaires_id' => 'required',
            'newClasse.groupe_classe_id' => 'nullable',
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

            $this->insertLog(Auth::id(), 'CREATION', "Ajout la classe " . $validationAttributes["newClasse"]["nom"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La classe a créée avec succès!"]);
        } catch (Exception $e) {
            dd($e->getMessage());
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
            $this->insertLog(Auth::id(), 'MODIFICATION', "Mise à jour de la classe " . $validationAttributes["editClasse"]["nom"]);
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
            $classe = Classe::find($id);
            $classe->destroy($classe->id);
            $this->insertLog(Auth::id(), 'SUPRESSION', "Supression de la classe " . $classe->nom);
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
