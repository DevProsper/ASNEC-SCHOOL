<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Classe;
use App\Models\Matiere;
use Livewire\Component;
use App\Models\EmploiDuTemp;
use Livewire\WithPagination;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Log;

class EmploieDuTempComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;

    public $rows = [];
    public $editEmplois = [];
    public $newEmplois = [];

    public $classe_id;
    public $matiere_id;
    public $anneesscolaire_id;
    public $nom;

    public $matierej1;
    public $matierej2;
    public $matierej3;
    public $matierej4;
    public $matierej5;
    public $matierej6;
    public $matierej7;

    public $valeur1;
    public $valeur2;
    public $valeur3;
    public $valeur4;
    public $valeur5;
    public $valeur6;
    public $valeur7;

    public $heure;

    public $anneeScolaireParDefaut;
    public $anneeScolaire;

    public $selectedClasse = null;
    public $selectedAnneeScolaire = null;


    public function addRow()
    {
        $this->rows[] = [
            'matieriej1' => '',
            'matieriej2' => '',
            'matieriej3' => '',
            'matieriej4' => '',
            'matieriej5' => '',
            'matieriej6' => '',
            'matieriej7' => '',
            'heure' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }

    public function mount()
    {
        // Récupérer l'année scolaire par défaut si aucune année n'est sélectionnée
        $this->anneeScolaireParDefaut = AnneeScolaire::where('defaut', 1)->value('id');

        // Appliquer l'année scolaire par défaut à la sélection si aucune année n'est sélectionnée
        $this->anneeScolaire = $this->anneeScolaire ?? $this->anneeScolaireParDefaut;
    }

    public function render()
    {
        Carbon::setLocale("fr");

        $query = EmploiDuTemp::with([
            'classe',
            'matiere1', 'matiere2', 'matiere3',
            'matiere4', 'matiere5', 'matiere6',
            'matiere7'
        ]);

        if ($this->selectedClasse) {
            $query->where('classe_id', $this->selectedClasse);
        }

        if ($this->selectedAnneeScolaire) {
            $query->where('anneesscolaire_id', $this->selectedAnneeScolaire);
        }

        $emplois = $query->get();
        $classes = Classe::all();
        $matieres = Matiere::all();
        $anneesscolaires = AnneeScolaire::all();
        $annees = AnneeScolaire::where('defaut', 1)->get();

        return view(
            'livewire.modules.emploisdutemps.index',
            compact('emplois', 'classes', 'anneesscolaires', 'matieres', 'annees'),
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListEmplois()
    {
        $this->currentPage = PAGELIST;
    }

    public function goToEditEmplois($id)
    {
        $this->editEmplois = EmploiDuTemp::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'newEmplois.nom' => 'required',
                'newEmplois.classe_id' => 'required',
                'newEmplois.anneesscolaire_id' => 'required'
            ];
        }

        return [
            'newEmplois.nom' => 'required',
            'newEmplois.classe_id' => 'required',
        ];
    }

    public function goToAddEmploisDuTemps()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function save()
    {
        $validationAttributes = $this->validate();
        try {
            foreach ($this->rows as $row) {
                $valeur1 = isset($row['matierej1']) ? $row['matierej1'] : NULL;
                $valeur2 = isset($row['matierej2']) ? $row['matierej2'] : NULL;
                $valeur3 = isset($row['matierej3']) ? $row['matierej3'] : NULL;
                $valeur4 = isset($row['matierej4']) ? $row['matierej4'] : NULL;
                $valeur5 = isset($row['matierej5']) ? $row['matierej5'] : NULL;
                $valeur6 = isset($row['matierej6']) ? $row['matierej6'] : NULL;
                $valeur7 = isset($row['matierej7']) ? $row['matierej7'] : NULL;
                EmploiDuTemp::create([ //updateEmplois
                    'heure' =>  $row['heure'],
                    'anneesscolaire_id' => $this->anneesscolaire_id,
                    'classe_id' => $validationAttributes["newEmplois"]['classe_id'],
                    'nom' => $validationAttributes["newEmplois"]['nom'],
                    'matierej1' => $valeur1,
                    'matierej2' => $valeur2,
                    'matierej3' => $valeur3,
                    'matierej4' => $valeur4,
                    'matierej5' => $valeur5,
                    'matierej6' => $valeur6,
                    'matierej7' => $valeur7
                ]);
            }

            // Réinitialiser les lignes après l'insertion
            $this->rows = [];
            $this->newEmplois = [];
            $this->heure = "";
            $this->anneesscolaire_id = "";
            $this->nom = "";
            $this->classe_id = "";

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "L'emplois du temps a bien été crée avec succès !"]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            dd($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création de l'emplois du temps."]);
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

    public function deleteEmplois($id)
    {
        try {
            EmploiDuTemp::destroy($id);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "la ligne de l'emplois du temps a été supprimé avec succès!"]);
        } catch (Exception $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cette ligne de  l'emplois du temps est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de la ligne l'emplois du temps."]);
            }
        }
    }
}
