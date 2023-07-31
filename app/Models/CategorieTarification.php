<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieTarification extends Model
{
    use HasFactory;

    protected $table = "categoriestarifications";

    protected $fillable = [
        'nom',
        'statut'
    ];

    public function tarifications()
    {
        return $this->hasMany(Tarification::class);
    }
}
