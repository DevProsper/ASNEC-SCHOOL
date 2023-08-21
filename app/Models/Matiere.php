<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'nomCourt',
        'coefficient',
        'statut'
    ];

    public function classes()
    {
        return $this->belongsToMany(
            Classe::class,
            "matiere_classe",
            "matiere_id",
            "classe_id"
        );
    }

    public function getAllClasseNamesAttribute()
    {
        return $this->classes->implode("nom", ' , ');
    }

    public function emploisdutemps_j1()
    {
        return $this->hasMany(Emploisdutemps::class, 'matierej1');
    }

    public function emploisdutemps_j2()
    {
        return $this->hasMany(Emploisdutemps::class, 'matierej2');
    }

    public function emploisdutemps_j3()
    {
        return $this->hasMany(Emploisdutemps::class, 'matierej3');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'matiere_id');
    }
}
