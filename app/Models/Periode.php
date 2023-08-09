<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = "periodes";

    protected $fillable = [
        'nom',
        'categorieperiode_id',
        'statut'
    ];

    public function categorie()
    {
        return $this->belongsTo(CategoriePeriode::class, 'categorieperiode_id');
    }
}
