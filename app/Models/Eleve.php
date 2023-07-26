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
        'telephone1',
        'dateNaissance',
        'lieuNaissance',
        'email',
        'description',
        'classe_id',
        'parent_id',
        'anneesscolaire_id',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, "classe_id");
    }

    public function parent()
    {
        return $this->belongsTo(ParentEl::class, "parent_id");
    }

    public function anneesscolaire()
    {
        return $this->belongsTo(ParentEl::class, "anneesscolaire_id");
    }
}
