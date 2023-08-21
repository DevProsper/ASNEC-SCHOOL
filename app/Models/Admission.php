<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'eleve_id',
        'anneesscolaire_id',
        'tarification_id',
        'statutAdmission',
        'etat'
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function anneesscolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'anneesscolaire_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'admission_id');
    }

    public function tarification()
    {
        return $this->belongsTo(Tarification::class, 'tarification_id');
    }

    public function caisses()
    {
        return $this->hasMany(Caisse::class, 'admission_id');
    }
}
