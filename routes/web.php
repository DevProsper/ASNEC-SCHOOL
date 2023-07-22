<?php

use App\Models\Batiment;
use App\Models\Trimestre;
use App\Models\Tarification;
use App\Models\NiveauScolaire;
use App\Http\Livewire\MoiComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\SalleComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ClasseComponent;
use App\Http\Livewire\MatiereComponent;
use App\Http\Livewire\BatimentComponent;
use App\Http\Livewire\TrimestreComponent;
use App\Http\Livewire\UtilisateurComponent;
use App\Http\Livewire\TarificationComponent;
use App\Http\Livewire\AnneeScolaireComponent;
use App\Http\Livewire\NiveauScolaireComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Le groupe des routes relatives aux administrateurs uniquement
Route::group([
    "middleware" => ["auth", "auth.administration"],
    'as' => 'administration.'
], function () {

    Route::group([
        "prefix" => "annees",
        'as' => 'annees.'
    ], function () {
        Route::get('/anneesscolaires', AnneeScolaireComponent::class)->name('scolaires.index');
    });

    Route::group(
        [
            "prefix" => "niveaux",
            'as' => 'niveaux.'
        ],
        function () {
            Route::get('/niveauxcolaires', NiveauScolaireComponent::class)->name('nvscolaires.index');
        }
    );

    Route::group(
        [
            "prefix" => "tarifications",
            'as' => 'tarifications.'
        ],
        function () {
            Route::get('/tarif', TarificationComponent::class)->name('tarifications.index');
        }
    );

    Route::group(
        [
            "prefix" => "classes",
            'as' => 'classes.'
        ],
        function () {
            Route::get('/classes', ClasseComponent::class)->name('classes.index');
        }
    );

    Route::group(
        [
            "prefix" => "matieres",
            'as' => 'matieres.'
        ],
        function () {
            Route::get('/matieres', MatiereComponent::class)->name('matieres.index');
        }
    );

    Route::group(
        [
            "prefix" => "batiments",
            'as' => 'batiments.'
        ],
        function () {
            Route::get('/batiments', BatimentComponent::class)->name('batiments.index');
        }
    );

    Route::group(
        [
            "prefix" => "trimestres",
            'as' => 'trimestres.'
        ],
        function () {
            Route::get('/trimestres', TrimestreComponent::class)->name('trimestres.index');
        }
    );

    Route::group(
        [
            "prefix" => "mois",
            'as' => 'mois.'
        ],
        function () {
            Route::get('/mois', MoiComponent::class)->name('mois.index');
        }
    );

    Route::group(
        [
            "prefix" => "salles",
            'as' => 'salles.'
        ],
        function () {
            Route::get('/salles', SalleComponent::class)->name('salles.index');
        }
    );
});

Route::group([
    "middleware" => ["auth", "auth.utilisateurs"],
    'as' => 'users.'
], function () {
    Route::get('/utilisateurs', UtilisateurComponent::class)->name('utilisateurs.index');
});
