<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeClasse extends Model
{
    use HasFactory;

    protected $table = "groupe_classes";

    protected $fillable = [
        'nom'
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
