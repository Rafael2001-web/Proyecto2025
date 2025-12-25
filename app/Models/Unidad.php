<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidad extends Model
{
    use HasFactory;

    protected $primaryKey = 'idUnidad';
    public $timestamps = false;
    protected $table = 'unidad';

    protected $fillable = [
        'macrosector',
        'sector',
        'estado'
    ];

    // RELACIONES
    
    /**
     * Una unidad tiene muchas entidades
     */
    public function entidades(): HasMany
    {
        return $this->hasMany(Entidad::class, 'idUnidad', 'idUnidad');
    }

    // RELACIONES CALCULADAS - A través de entidades
    
    /**
     * Obtener todos los planes de las entidades de esta unidad
     */
    public function planes()
    {
        return $this->hasManyThrough(
            Plan::class,
            Entidad::class,
            'idUnidad',
            'idEntidad',
            'idUnidad',
            'idEntidad'
        );
    }

    /**
     * Obtener todos los programas de las entidades de esta unidad
     */
    public function programas()
    {
        return $this->hasManyThrough(
            Programa::class,
            Entidad::class,
            'idUnidad',
            'idEntidad',
            'idUnidad',
            'idEntidad'
        );
    }
}

