<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'statut'
    ];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, "matiere_classe", "matiere_id", "classe_id");
    }

    public function getAllClasseNamesAttribute()
    {
        return $this->classes->implode("nom", ' , ');
    }
}
