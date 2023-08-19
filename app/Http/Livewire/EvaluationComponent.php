<?php

namespace App\Http\Livewire;

use App\Models\Admission;
use App\Models\Classe;
use Livewire\Component;
use App\Traits\Loggable;
use App\Models\Evaluation;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use App\Traits\BaseQueryEleve;

class EvaluationComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $anneeScolaireParDefaut;

    public $currentPage = PAGELIST;

    use WithPagination, Loggable, BaseQueryEleve;
    public $newEvaluation = [];
    public $editEvaluation = [];
    public $rows = [];

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
            'matiere' => '',
            'note' => '',
            'type' => '',
            'dateEvaluation' => '',
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
        $classes = Classe::all();

        return view(
            'livewire.modules.evaluations.index',
            compact(
                "eleves",
                "classes",
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
    }

    public function goToAddEvaluation()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditEvaluation($id)
    {
        $this->editEvaluation = Admission::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }
}
