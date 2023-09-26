<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Periode;
use Livewire\Component;
use App\Models\Evaluation;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;

class NotePrimaireComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;

    public $classeId;
    public $periodeId;

    public $eleveSearch;

    public $moyenne;
    public $editNote;
    public $editNote2;
    public $MatiereD;

    public $nomEleve;
    public $classEleve;
    public $classe_id;
    public $matiereId;

    public $anneeScolaireParDefaut;
    public $anneeScolaireId;
    public $AnneeScolaire;

    public function mount()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaireId = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;
    }

    public function render()
    {
        $anneesscolaires = AnneeScolaire::all();
        $periodes = Periode::whereIn('categorieperiode_id', [1])->get();
        $classes = Classe::whereIn('niveauxscolaires_id', [3])->get();

        $matieres = Matiere::whereNull('nomCourt')->get();

        $query = Evaluation::with([
            'admission.eleve',
            'admission.classe',
            'periode',
            'matiere'
        ]);

        if ($this->anneeScolaireId) {
            $query->whereHas('admission', function ($query) {
                $query->where('anneesscolaire_id', $this->anneeScolaireId);
            });
        }

        if ($this->classeId) {
            $query->whereHas('admission', function ($query) {
                $query->where('classe_id', $this->classeId);
            });
        }

        if ($this->periodeId) {
            $query->where('periode_id', $this->periodeId);
        }

        if ($this->eleveSearch) {
            $query->whereHas('admission.eleve', function ($query) {
                $query->where('nom', 'like', '%' . $this->eleveSearch . '%');
            });
            $query->whereHas('admission.eleve', function ($query) {
                $query->orWhere('telephone', 'like', '%' . $this->eleveSearch . '%');
            });
            $query->whereHas('admission.eleve', function ($query) {
                $query->orWhere('telephoneTiteur', 'like', '%' . $this->eleveSearch . '%');
            });
        }

        if ($this->matiereId) {
            $query->where('matiere_id', $this->matiereId);
        }

        $query->whereHas('admission.classe', function ($query) {
            $query->where('niveauxscolaires_id', 3);
        });

        $query->orderBy('created_at', 'desc');

        $evaluations = $query->get();


        return view(
            'livewire.modules.evaluations_p.notes_p.index',
            compact("evaluations", "anneesscolaires", "periodes", "classes", "matieres")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editNote.matiere_id' => 'required',
                'editNote.periode_id' => 'required',
                'editNote.noteDevoir1' => 'nullable',
                'editNote.noteDevoir2' => 'nullable',
                'editNote.noteDevoir3' => 'nullable',
                'editNote.noteExamen' => 'nullable'
            ];
        }

        return [];
    }

    public function goToListNote()
    {
        $this->currentPage = PAGELIST;
    }

    public function goToEditNote($id)
    {
        $this->editNote2 = Evaluation::find($id);
        $this->editNote = Evaluation::find($id)->toArray();
        $this->nomEleve = $this->editNote2->admission->eleve->nom . " " . $this->editNote2->admission->eleve->prenom;
        $this->classEleve = $this->editNote2->admission->classe->nom;
        $this->AnneeScolaire = $this->editNote2->admission->anneesscolaire->nom;
        $this->MatiereD = $this->editNote2->matiere->nom;

        $this->classe_id = $this->editNote2->admission->classe_id;

        $this->currentPage = PAGEEDITFORM;
    }

    public function updateNote()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            Evaluation::find($this->editNote["id"])->update($validationAttributes["editNote"]);
            $this->dispatchBrowserEvent(
                "showSuccessMessage",
                ["message" => "Les notes ont été mise à jour avec succès!"]
            );
        } catch (Exception $e) {
            $this->dispatchBrowserEvent(
                "showErrorMessage",
                ["message" => "Une erreur s'est produite lors de la mise à jour des notes."]
            );
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de supprimer les notes de la matière  $nom de la liste. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "data_id" => $id
            ]
        ]]);
    }

    public function deleteNote($id)
    {
        try {
            Evaluation::destroy($id);

            $this->dispatchBrowserEvent(
                "showSuccessMessage",
                ["message" => "Les notes ont été supprimée avec succès!"]
            );
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent(
                    "showErrorMessage",
                    ["message" => "Impossible ! Ces notes sont déjà liées à d'autres données."]
                );
            } else {
                $this->dispatchBrowserEvent(
                    "showErrorMessage",
                    ["message" => "Une erreur s'est produite lors de la suppression des notes."]
                );
            }
        }
    }
}
