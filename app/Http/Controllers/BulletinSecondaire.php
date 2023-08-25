<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Periode;
use App\Models\Admission;
use App\Models\Evaluation;

class BulletinSecondaire extends Controller
{
    public $evaluationsAvecMoyennes = [];
    public function calculerMoyenne($donnees)
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

    public function index($admission_id, $periode_id)
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

        foreach ($evaluations as $evaluation) {
            $notes = [];

            if ($evaluation['noteDevoir1'] != null) {
                $notes[] = $evaluation['noteDevoir1'];
            }

            if ($evaluation['noteDevoir2'] != null) {
                $notes[] = $evaluation['noteDevoir2'];
            }

            if ($evaluation['noteDevoir3'] != null) {
                $notes[] = $evaluation['noteDevoir3'];
            }

            $moyenne = $this->calculerMoyenne($notes);
            $this->evaluationsAvecMoyennes = $moyenne;
        }


        $data = [
            'evaluations' => $evaluations,
            'moyenne' => $this->evaluationsAvecMoyennes
        ];

        dd($this->evaluationsAvecMoyennes);

        $pdf = PDF::loadView('livewire.modules.pdf.liste', $data)->setPaper('A4', 'portrait');
        //landscape , portrait
        return $pdf->stream('fichier.pdf');
    }
}
