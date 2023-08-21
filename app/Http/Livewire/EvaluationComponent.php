<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\User;
use App\Models\Classe;
use App\Models\Matiere;
use Livewire\Component;
use App\Traits\Loggable;
use App\Models\Admission;
use App\Models\Evaluation;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use App\Models\Periode;
use App\Traits\BaseQueryEleve;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvaluationComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $anneeScolaireParDefaut;

    public $currentPage = PAGELIST;

    use WithPagination, Loggable, BaseQueryEleve;
    public $newEvaluation = [];
    public $editEvaluation = [];
    public $rows = [];

    public $matieres;

    public $nomComplet;
    public $classe;
    public $statut;
    public $admission_id;
    public $classe_id;

    protected $messages = [
        'newEvaluation.nom.required' => "l'année évaluation est obligatoire.",

        'editEvaluation.nom.required' => "l'année évaluation est obligatoire.",
    ];

    public function mount()
    {
        $this->rafraishir();
    }

    public function addRow()
    {
        $this->rows[] = [
            'matiere_id' => '',
            'noteDevoir1' => '',
            'noteDevoir2' => '',
            'noteDevoir3' => '',
            'noteExamen' => '',
            'periode_id' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }

    public function render()
    {
        $eleves = $this->listeEleveParClasseAnneeSexe();
        $anneesscolaires = AnneeScolaire::all();
        $periodes = Periode::whereIn('categorieperiode_id', [1, 2])->get();
        $classes = Classe::all();
        $matieres = Matiere::all();

        return view(
            'livewire.modules.evaluations.index',
            compact(
                "eleves",
                "classes",
                "periodes",
                "matieres",
                "anneesscolaires"
            )
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function rafraishir()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaire = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;
    }

    public function goToListEvaluation()
    {
        $this->currentPage = PAGELIST;
        $this->editEvaluation = [];
        $this->nomComplet = "";
        $this->matieres = "";
        $this->classe = "";
        $this->statut = "";
        $this->admission_id = "";
        $this->rows = [];
    }

    public function goToAddEvaluation($id)
    {
        $this->newEvaluation = Admission::find($id);
        $this->nomComplet = $this->newEvaluation->eleve->nom . " " . $this->newEvaluation->eleve->prenom;
        $this->classe = $this->newEvaluation->classe->nom;
        $this->statut = $this->newEvaluation->statutAdmission;
        $this->admission_id = $this->newEvaluation->id;
        $this->classe_id = $this->newEvaluation->classe_id;

        $this->matieres = DB::select("
            SELECT matieres.id, matieres.nom
            FROM matieres
            JOIN matiere_classe ON matieres.id = matiere_classe.matiere_id
            WHERE matiere_classe.classe_id = ?
        ", [$this->classe_id]);


        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditEvaluation($id)
    {
        $this->editEvaluation = Admission::find($id)->toArray();
        $this->currentPage = PAGECREATEFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'note' => 'nullable',
                'admission_id'  => 'nullable',
                'matiere_id'    => 'nullable',
                'periode_id'    => 'nullable',
                'type'          => 'nullable',
                'dateEvaluation'     => 'nullable'
            ];
        }

        return [
            'noteDevoir1' => 'nullable',
            'noteDevoir2' => 'nullable',
            'noteDevoir3' => 'nullable',
            'noteExamen' => 'nullable',
            'admission_id'  => 'nullable',
            'matiere_id'    => 'nullable',
            'periode_id'    => 'nullable',
        ];
    }

    public function save()
    {
        //$this->validate();
        try {
            foreach ($this->rows as $row) {
                $noteDevoir1 = isset($row['noteDevoir1']) ? $row['noteDevoir1'] : NULL;
                $noteDevoir2 = isset($row['noteDevoir2']) ? $row['noteDevoir2'] : NULL;
                $noteDevoir3 = isset($row['noteDevoir3']) ? $row['noteDevoir3'] : NULL;
                $noteExamen = isset($row['noteExamen']) ? $row['noteExamen'] : NULL;
                $matiere = isset($row['matiere_id']) ? $row['matiere_id'] : NULL;
                $periode = isset($row['periode_id']) ? $row['periode_id'] : NULL;
                Evaluation::create([
                    //updateEmplois
                    'admission_id' =>  $this->admission_id,
                    'matiere_id' => $matiere,
                    'periode_id' => $periode,
                    'noteDevoir1' => $noteDevoir1,
                    'noteDevoir2' => $noteDevoir2,
                    'noteDevoir3' => $noteDevoir3,
                    'noteExamen' => $noteExamen
                ]);
            }
            // Réinitialiser les lignes après l'insertion
            $this->rows = [];
            /*$this->newEmplois = [];
            $this->heure = "";
            $this->anneesscolaire_id = "";
            $this->nom = "";
            $this->classe_id = "";*/

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Les notes ont bel et bien été attribuées avec succès !"]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            dd($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création des notes."]);
        }
    }

    public function updateEvaluation()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            Evaluation::find($this->editEmploi["id"])->update($validationAttributes["editEmploi"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La ligne de l'empois du temps a été mise à jour avec succès!"]);
        } catch (Exception $e) {
            dd($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour des données."]);
        }
    }
}
