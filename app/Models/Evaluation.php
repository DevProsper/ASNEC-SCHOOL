<?php

namespace App\Models;

use App\Models\Matiere;
use App\Models\Periode;
use App\Models\Admission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'noteDevoir1',
        'noteDevoir2',
        'noteDevoir3',
        'noteExamen',
        'admission_id',
        'periode_id',
        'matiere_id',
        'moyenneDevoir'
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
}
