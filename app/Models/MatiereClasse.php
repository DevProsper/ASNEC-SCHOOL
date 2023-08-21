<?php

namespace App\Models;

use App\Models\Matiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MatiereClasse extends Model
{
    use HasFactory;

    protected $table = 'matiere_classe';

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }
}
