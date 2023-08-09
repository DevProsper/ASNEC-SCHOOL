<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriePeriode extends Model
{
    use HasFactory;

    protected $table = "categorieperiodes";

    protected $fillable = [
        'nom',
        'statut'
    ];

    public function periodes()
    {
        return $this->hasMany(Periode::class, 'categorieperiode_id');
    }
}
