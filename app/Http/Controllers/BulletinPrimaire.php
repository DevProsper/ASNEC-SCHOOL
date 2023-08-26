<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Support\Facades\DB;
use PDF;

class BulletinPrimaire extends Controller
{
    public function index($admission_id, $periode_id, $eleve_id = null)
    {

        $evaluations =
            Evaluation::select(
                'evaluations.*',
                'periodes.nom as periode_nom',
                'matieres.nom as matiere_nom',
                'matieres.coefficient'
            )
            ->join('periodes', 'periodes.id', '=', 'evaluations.periode_id')
            ->join('matieres', 'matieres.id', '=', 'evaluations.matiere_id')
            ->where('evaluations.admission_id', $admission_id)
            ->where('evaluations.periode_id', $periode_id)
            ->get()
            ->toArray();

        $admission = DB::table('admissions')
            ->select(
                'admissions.*',
                'eleves.nom as eleve_nom',
                'eleves.nomTiteur as nomTiteur',
                'eleves.prenomTiteur as prenomTiteur',
                'eleves.adresseTiteur as adresseTiteur',
                'eleves.dateNaissance as dateNaissance',
                'eleves.lieuNaissance as lieuNaissance',
                'eleves.prenom as eleve_prenom',
                'anneesscolaires.nom as annee_nom',
                'classes.nom as classe_nom',
                'periodes.nom as periode',
            )
            ->join('eleves', 'eleves.id', '=', 'admissions.eleve_id')
            ->join('classes', 'classes.id', '=', 'admissions.classe_id')
            ->join('anneesscolaires', 'anneesscolaires.id', '=', 'admissions.anneesscolaire_id')

            ->join('evaluations', 'evaluations.admission_id', '=', 'admissions.id')
            ->join('periodes', 'periodes.id', '=', 'evaluations.periode_id')

            ->where('evaluations.periode_id', $periode_id)
            ->where('admissions.id', $admission_id)
            ->first();

        $data = [
            'evaluations' => $evaluations,
            'admission'   => $admission
        ];

        $pdf = PDF::loadView('livewire.modules.bulletin_eleves.niveau_primaire', $data)->setPaper('A4', 'portrait');
        //landscape , portrait
        return $pdf->stream('fichier.pdf');
    }
}
