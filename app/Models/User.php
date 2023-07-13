<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'statut',
        'telephone1'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mouchards()
    {
        return $this->hasMany(Mouchard::class);
    }

    //============================= MODULES APPLICATIONS =============================
    public function modules()
    {
        return $this->belongsToMany(Module::class, "user_module", "user_id", "module_id");
    }

    public function hasModule($module)
    {
        return $this->modules()->where("nom", $module)->first() !== null;
    }

    public function hasAnyModules($modules)
    {
        return $this->modules()->whereIn("nom", $modules)->first() !== null;
    }

    public function getAllModuleNamesAttribute()
    {
        return $this->modules->implode("nom", ' | ');
    }
}
