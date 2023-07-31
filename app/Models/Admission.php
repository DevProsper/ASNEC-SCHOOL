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
        'statut'
    ];
}
