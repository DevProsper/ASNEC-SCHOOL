<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'acceuil',
        'niveauxscolaire_id',
        'tarification_id',
        'statut'
    ];

    public function niveauScolaire()
    {
        return $this->belongsTo(NiveauScolaire::class, "niveauxscolaire_id");
    }

    public function tarification()
    {
        return $this->belongsTo(Tarification::class, "tarification_id");
    }

    public function matieres()
    {
        return $this->belongsToMany(Classe::class, "matiere_classe", "matiere_id", "classe_id");
    }

    public function getAllMatiereNamesAttribute()
    {
        return $this->matieres->implode("nom", ' | ');
    }

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
}
