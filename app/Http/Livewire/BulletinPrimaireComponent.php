<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Periode;
use Livewire\Component;
use App\Traits\Loggable;
use App\Models\Evaluation;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;

class BulletinPrimaireComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;
    public $anneeScolaireParDefaut;

    use WithPagination, Loggable;

    public $anneeScolaireId;
    public $classeId;
    public $periodeId;
    public $matiereId;

    public $AnneeScolaire;

    public $eleveSearch;

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
        $periodes = Periode::whereIn('categorieperiode_id', [1])->get();
        $classes = Classe::whereIn('niveauxscolaires_id', [3])->get();

        $matieres = Matiere::whereNotNull('nomCourt')->get();

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
                $query->whereRaw("CONCAT(nom, ' ', prenom) LIKE ?", '%' . $this->eleveSearch . '%');
                //$query->where('nom', 'like', '%' . $this->eleveSearch . '%');
            });
            $query->whereHas('admission.eleve', function ($query) {
                $query->orWhere('telephone', 'like', '%' . $this->eleveSearch . '%');
            });
            $query->whereHas('admission.eleve', function ($query) {
                $query->orWhere('telephoneTiteur', 'like', '%' . $this->eleveSearch . '%');
            });
        }

        $query->whereHas('admission.classe', function ($query) {
            $query->where('niveauxscolaires_id', 3);
        });


        $evaluations = $query->get();


        return view(
            'livewire.modules.bulletins_p.index',
            compact("evaluations", "anneesscolaires", "classes", "matieres", "periodes")
        )
            ->extends("layouts.master")
            ->section("contenu");
    }
}
