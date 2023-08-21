<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Periode;
use Livewire\Component;
use App\Models\Evaluation;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;

class NoteComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;
    public $anneeScolaireParDefaut;

    use WithPagination;

    public $anneeScolaireId;
    public $classeId;
    public $periodeId;
    public $triEleveNom = null;
    public $triEleveTel = null;

    public $moyenne;

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
        $periodes = Periode::whereIn('categorieperiode_id', [1, 2])->get();
        $classes = Classe::all();

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

        if ($this->triEleveNom) {
            $query->orderBy('eleves.nom', $this->triEleveNom);
        }

        if ($this->triEleveTel) {
            $query->orderBy('eleves.tel', $this->triEleveTel);
        }

        $query->orderBy('created_at', 'desc');

        $evaluations = $query->get();


        return view(
            'livewire.modules.evaluations.notes.index',
            compact("evaluations", "anneesscolaires", "periodes", "classes")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListNote()
    {
        $this->currentPage = PAGELIST;
    }
}
