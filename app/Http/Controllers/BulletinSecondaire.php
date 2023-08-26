<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Periode;
use App\Models\Admission;
use App\Models\Evaluation;

class BulletinSecondaire extends Controller
{
    public function index($admission_id, $periode_id)
    {

        $evaluations =
            Evaluation::select(
                'evaluations.*',
                'periodes.nom as periode_nom',
                'matieres.nomCourt as matiere_nom',
                'matieres.coefficient'
            )
            ->join('periodes', 'periodes.id', '=', 'evaluations.periode_id')
            ->join('matieres', 'matieres.id', '=', 'evaluations.matiere_id')
            ->where('evaluations.admission_id', $admission_id)
            ->where('evaluations.periode_id', $periode_id)
            ->get()
            ->toArray();


        $data = [
            'evaluations' => $evaluations
        ];

        $pdf = PDF::loadView('livewire.modules.pdf.liste', $data)->setPaper('A4', 'portrait');
        //landscape , portrait
        return $pdf->stream('fichier.pdf');
    }
}
