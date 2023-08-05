<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarification extends Model
{
    use HasFactory;

    protected $table = "tarifications";

    protected $fillable = [
        'nom',
        'prix',
        'statut',
        'categoriestarification_id',
        'anneesscolaire_id',
        'classe_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(CategorieTarification::class, 'categoriestarification_id');
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'anneesscolaire_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'tarification_id');
    }
}
