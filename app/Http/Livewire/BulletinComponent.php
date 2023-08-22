<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Periode;
use Livewire\Component;
use App\Traits\Loggable;
use App\Models\Evaluation;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;

class BulletinComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;
    public $anneeScolaireParDefaut;

    use WithPagination, Loggable;

    public $anneeScolaireId;
    public $classeId;
    public $periodeId;
    public $matiereId;

    public $eleveSearch;

    public function mount()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaireId = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;
    }

    private function calculerMoyenne($donnees)
    {
        $somme = array_sum($donnees);
        $nombreElements = count($donnees);

        if ($nombreElements > 0) {
            $moyenne = $somme / $nombreElements;
            return $moyenne;
        } else {
            return 0;
        }
    }

    public function render()
    {
        /*$anneesscolaires = AnneeScolaire::all();
        $periodes = Periode::whereIn('categorieperiode_id', [2])->get();
        $classes = Classe::all();
        $matieres = Matiere::all();

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

        $query->orderBy('created_at', 'desc');

        $evaluations = $query->get();

        $donnees = [10, 15, 20, 25, 30];
        $moyenne = $this->calculerMoyenne($donnees);*/

        $evaluations = Evaluation::all();

        foreach ($evaluations as $evaluation) {
            $notes = [];

            if ($evaluation->noteDevoir1 != null) {
                $notes[] = $evaluation->noteDevoir1;
            }

            if ($evaluation->noteDevoir2 != null) {
                $notes[] = $evaluation->noteDevoir2;
            }

            if ($evaluation->noteDevoir3 != null) {
                $notes[] = $evaluation->noteDevoir3;
            }

            $moyenne = $this->calculerMoyenne($notes);
            $evaluation->moyenne = $moyenne;
        }


        return view(
            'livewire.modules.bulletins.index',
            compact("evaluations")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }
}
