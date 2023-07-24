<?php

namespace App\Models;

use App\Models\Diplome;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'telephone1',
        'telephone2',
        'email',
        'dateContrtat',
        'typeContrat',
        'diplome_id',
        'duree',
        'statut'
    ];

    public function diplome()
    {
        return $this->belongsTo(Diplome::class, "diplome_id");
    }
}
