<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Periode;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CategoriePeriode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeriodeComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newPeriode = [];
    public $editPeriode = [];

    public $categorieId;

    protected $messages = [
        'newPeriode.nom.required' => "le nom de la préiode est obligatoire.",
        'newPeriode.categorieperiode_id.required' => "La catégotie de la période est obligatoire",

        'editPeriode.nom.required' => "le nom de la préiode est obligatoire.",
        'editPeriode.categorieperiode_id.required' => "La catégotie de la période est obligatoire",
    ];

    public function render()
    {
        Carbon::setLocale("fr");

        $periodes = Periode::query();

        if ($this->categorieId) {
            $periodes->where('categorieperiode_id', $this->categorieId);
        }

        $periodes = $periodes->paginate(10);
        $categories = CategoriePeriode::all();

        return view(
            'livewire.modules.administrations.periodes.index',
            compact(
                "periodes",
                "categories"
            )
        )
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListPeriode()
    {
        $this->currentPage = PAGELIST;
        $this->editPeriode = [];
    }

    public function goToAddPeriode()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditPeriode($id)
    {
        $this->editPeriode = Periode::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editPeriode.nom' => 'required',
                'editPeriode.categorieperiode_id' => 'required',
            ];
        }

        return [
            'newPeriode.nom' => 'required',
            'newPeriode.categorieperiode_id' => 'required',
        ];
    }

    public function addPeriode()
    {
        $validationAttributes = $this->validate();
        try {
            DB::beginTransaction();
            Periode::create($validationAttributes["newPeriode"]);
            DB::commit();
            $this->newPeriode = [];

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La période a créée avec succès!"]);
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            Log::error($e->getMessage());
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la création de la période."]);
        }
    }

    public function updatePeriode()
    {
        $validationAttributes = $this->validate();
        try {
            Periode::find($this->editPeriode["id"])->update($validationAttributes["editPeriode"]);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La période a été mise à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de la Periode."]);
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

    public function deletePeriode($id)
    {
        try {
            Periode::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "La période a été supprimée avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cette période est liée à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de la Periode."]);
            }
        }
    }
}
