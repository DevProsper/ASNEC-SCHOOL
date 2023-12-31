<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $table = "anneesscolaires";

    protected $fillable = [
        'nom',
        'dateDebut',
        'dateFin',
        'description',
        'defaut',
        'statut'
    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }

    public function tarifications()
    {
        return $this->hasMany(Tarification::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'anneesscolaire_id');
    }
}
