<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemp extends Model
{
    use HasFactory;

    protected $table = "emploisdutemps";

    protected $fillable = [
        'classe_id', 'nom', 'heure', 'matierej1',
        'matierej2', 'matierej3', 'matierej4', 'matierej5',
        'matierej6', 'matierej7',
        'anneesscolaire_id'
    ];

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'anneesscolaire_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function matiere1()
    {
        return $this->belongsTo(Matiere::class, 'matierej1');
    }

    public function matiere2()
    {
        return $this->belongsTo(Matiere::class, 'matierej2');
    }

    public function matiere3()
    {
        return $this->belongsTo(Matiere::class, 'matierej3');
    }

    public function matiere4()
    {
        return $this->belongsTo(Matiere::class, 'matierej4');
    }

    public function matiere5()
    {
        return $this->belongsTo(Matiere::class, 'matierej5');
    }

    public function matiere6()
    {
        return $this->belongsTo(Matiere::class, 'matierej6');
    }

    public function matiere7()
    {
        return $this->belongsTo(Matiere::class, 'matierej7');
    }
}
