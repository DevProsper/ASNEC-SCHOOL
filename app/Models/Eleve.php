<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'sexe',
        'nom',
        'prenom',
        'telephone',
        'dateNaissance',
        'lieuNaissance',
        'email',
        'description',
        'classe_id',

        'nomTiteur',
        'prenomTiteur',
        'telephoneTiteur',
        'emailTiteur',
        'ProfessionTiteur',
        'AdresseTiteur',
        'defaut',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, "classe_id");
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'eleve_id');
    }
}
