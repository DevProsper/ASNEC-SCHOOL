<?php

namespace App\Models;

use App\Models\Caisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function caisses()
    {
        return $this->hasMany(Caisse::class, 'periode_id');
    }
}
