<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'statut'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, "user_module", "user_id", "module_id");
    }
}
