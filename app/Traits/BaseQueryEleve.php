<?php

namespace App\Traits;

use App\Models\Log;
use App\Models\Admission;
use App\Models\AnneeScolaire;

trait BaseQueryEleve
{
    public $anneeScolaire;
    public $classe;
    public $sexe;
    public $search;
    public $categorieTarificationId;
    public $totalAdmissions;
    public $totalFilles;
    public $totalGarcons;

    public function listeEleveParClasseAnneeSexe()
    {
        $eleves = Admission::query();

        if ($this->anneeScolaire) {
            $eleves->where('anneesscolaire_id', $this->anneeScolaire);
        }

        if ($this->classe) {
            $eleves->where('classe_id', $this->classe);
        }

        if ($this->sexe) {
            $eleves->whereHas('eleve', function ($query) {
                $query->where('sexe', $this->sexe);
            });
        }

        if ($this->search) {
            $eleves->whereHas('eleve', function ($query) {
                $query->where('nom', 'LIKE', '%' . $this->search . '%');
            });
        }

        if ($this->search) {
            $eleves->whereHas('eleve', function ($query) {
                $query->where('telephone', 'LIKE', '%' . $this->search . '%');
            });
        }

        if ($this->categorieTarificationId) {
            $eleves->whereHas('tarification', function ($query) {
                $query->where('categoriestarification_id', $this->categorieTarificationId);
            });
        }

        $eleves = $eleves->where('etat', 1);

        $this->totalAdmissions = $eleves->count();
        return $eleves->with('eleve', 'classe', 'anneesscolaire', 'tarification.categorie')->get();
    }
}
