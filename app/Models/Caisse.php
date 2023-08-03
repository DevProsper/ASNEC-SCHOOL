<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'anneesscolaire_id',
        'tarification_id',
        'montantVerse',
        'montantRestant',
        'statut', // 1-Terminé, 2-Accompte
        'etat', // 1 Entrées, 2 Dépenses
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id');
    }

    public function anneesscolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'anneesscolaire_id');
    }

    public function tarification()
    {
        return $this->belongsTo(Tarification::class, 'tarification_id');
    }
}
