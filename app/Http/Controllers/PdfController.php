<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use PDF;

class PdfController extends Controller
{
    public function index()
    {
        $data = Eleve::all();

        $pdf = PDF::loadView('livewire.modules.pdf.liste')->setPaper('A4', 'portrait', [
            'margin_top'    => 20,
            'margin_bottom' => 20,
            'margin_left'   => 15,
            'margin_right'  => 15,
        ]);
        //landscape , portrait
        return $pdf->stream('fichier.pdf');
        //return $pdf->download('fichier.pdf'); // Télécharge le PDF
    }
}
