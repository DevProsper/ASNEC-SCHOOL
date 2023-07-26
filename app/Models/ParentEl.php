<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentEl extends Model
{
    use HasFactory;

    protected $table = "parents";

    protected $fillable = [
        'sexe',
        'nom',
        'prenom',
        'telephone1',
        'telephone2',
        'relation',
        'profession',
        'email',
        'adresse'
    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'parent_id');
    }
}
