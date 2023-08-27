<?php

namespace App\Models;

use App\Models\Periode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'anneesscolaire_id',
        'tarification_id',
        'montantVerse',
        'montantVerse2',
        'montantRestant',
        'statut', // 1-Terminé, 2-Accompte
        'etat', // 1 Entrées, 2 Dépenses
        'periode_id',
        'admission_id'
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id');
    }

    public function anneesscolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'anneesscolaire_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }

    public function tarification()
    {
        return $this->belongsTo(Tarification::class, 'tarification_id');
    }
}
