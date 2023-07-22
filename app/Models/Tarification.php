<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarification extends Model
{
    use HasFactory;

    protected $table = "tarifications";

    protected $fillable = [
        'nom',
        'prix',
        'statut'
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
