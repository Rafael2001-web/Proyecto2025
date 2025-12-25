<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin(): bool
    {
        return $this->hasRole('Administrador del Sistema');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    // RELACIONES CALCULADAS - Obtener información de jerarquía
    public function entidades()
    {
        return $this->hasManyThrough(
            Entidad::class,
            Proyecto::class,
            'user_id',
            'idEntidad',
            'id',
            'idEntidad'
        )->distinct();
    }

    public function programas()
    {
        return $this->hasManyThrough(
            Programa::class,
            Proyecto::class,
            'user_id',
            'idPrograma',
            'id',
            'idPrograma'
        )->distinct();
    }

}
