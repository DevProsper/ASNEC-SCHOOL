<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    use HasFactory;

    protected $table = "niveauxscolaires";

    protected $fillable = [
        'nom',
        'ordre',
        'statut'
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
