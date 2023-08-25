<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use PDF;

class PdfController extends Controller
{
    public function index()
    {
        $data2 = "idadmission, idperiode, id_evaluation";
        $Collection = Eleve::all();

        $data = [
            'eleves' => $Collection
        ];

        //$pdf = PDF::loadView('livewire.modules.pdf.liste', $data)->setPaper('A4', 'portrait');
        //landscape , portrait
        return $pdf->stream('fichier.pdf');
        //return $pdf->download('fichier.pdf'); // Télécharge le PDF
    }
}
