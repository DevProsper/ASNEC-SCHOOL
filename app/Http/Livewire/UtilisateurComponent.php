<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Module;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilisateurComponent extends Component
{
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    use WithPagination;
    public $newUser = [];
    public $editUser = [];
    public $modulePermissions = [];
    public $search = "";

    protected $messages = [
        'newUser.name.required' => "le nom de l'utilisateur est obligatoire.",
        'newUser.email.required' => "l'adresse email est obligatoire.",
        'newUser.password.required' => "Le mot de passe est obligatoire.",

        'newUser.email.unique' => "L'adresse email est déjà utilisé pour un autre utilisateur.",
        'newUser.password.min' => "L'adresse email doit avoir au minimum 6 caractères.",

        'editUser.name.required' => "le nom de l'utilisateur est obligatoire.",
        'editUser.email.required' => "l'adresse email est obligatoire.",

        'editUser.email.unique' => "L'adresse email est déjà utilisé pour un autre utilisateur.",
        'editUser.password.min' => "L'adresse email doit avoir au minimum 6 caractères.",
    ];


    public function render()
    {
        Carbon::setLocale("fr");

        $users = User::latest();
        $search = $this->search;

        if ($search) {
            $users = $users->where('name', 'LIKE', '%' . $search . '%');
            $users = $users->orWhere("telephone1", "like", "%{$search}%");
        }

        $users = $users->paginate(1);

        return view('livewire.modules.utilisateurs.index', compact("users"))
            ->extends("layouts.master")
            ->section("contenu");
    }

    public function goToListUser()
    {
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }

    public function goToAddUser()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditUser($id)
    {
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;

        $this->populateModulePermissions();
    }

    public function populateModulePermissions()
    {
        $this->modulePermissions["modules"] = [];

        $mapForCB = function ($value) {
            return $value["id"];
        };

        $moduleIds = array_map($mapForCB, User::find($this->editUser["id"])->modules->toArray()); // [1, 2, 4]

        foreach (Module::all() as $module) {
            if (in_array($module->id, $moduleIds)) {
                array_push($this->modulePermissions["modules"], ["module_id" => $module->id, "module_nom" => $module->nom, "active" => true]);
            } else {
                array_push($this->modulePermissions["modules"], ["module_id" => $module->id, "module_nom" => $module->nom, "active" => false]);
            }
        }
    }

    public function updateModuleAndPermissions()
    {
        DB::table("user_module")->where("user_id", $this->editUser["id"])->delete();

        foreach ($this->modulePermissions["modules"] as $module) {
            if ($module["active"]) {
                User::find($this->editUser["id"])->modules()->attach($module["module_id"]);
            }
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "modules a été mis à jour avec succès!"]);
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {

            return [
                'editUser.name' => 'required',
                'editUser.password' => 'required|min:6',
                'editUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->editUser['id'])],
            ];
        }

        return [
            'newUser.name' => 'required',
            'newUser.password' => 'required|min:6',
            'newUser.email' => 'required|email|unique:users,email',
        ];
    }

    public function addUser()
    {
        $validationAttributes = $this->validate();

        $validationAttributes["newUser"]["password"] = Hash::make($validationAttributes["newUser"]["password"]);

        User::create($validationAttributes["newUser"]);

        $this->newUser = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur créé avec succès!"]);
    }

    public function updateUser()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
        try {
            $validationAttributes["editUser"]["password"] = Hash::make($validationAttributes["editUser"]["password"]);

            User::find($this->editUser["id"])->update($validationAttributes["editUser"]);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur mis à jour avec succès!"]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la mise à jour de l'utilisateur."]);
        }
    }

    public function confirmDelete($name, $id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "user_id" => $id
            ]
        ]]);
    }

    public function deleteUser($id)
    {
        try {
            User::destroy($id);

            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur supprimé avec succès!"]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion de l'erreur
            if ($e->getCode() === '23000') {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Impossible ! Cet utilisateur est lié à d'autres données."]);
            } else {
                $this->dispatchBrowserEvent("showErrorMessage", ["message" => "Une erreur s'est produite lors de la suppression de l'utilisateur."]);
            }
        }
    }
}
