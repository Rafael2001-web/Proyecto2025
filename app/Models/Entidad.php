<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entidad extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEntidad';
    public $timestamps = false;
    protected $table = 'entidad';

    protected $fillable = [
        'codigo',
        'subSector',
        'nivelGobierno',
        'estado',
        'fechaCreacion',
        'fechaActualizacion',
        'idUnidad'
    ];

    // RELACIONES DIRECTAS

    /**
     * Relación N:1 - Una entidad pertenece a una unidad
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'idUnidad', 'idUnidad');
    }

    /**
     * Relación 1:N - Una entidad tiene muchos programas
     */
    public function programas(): HasMany
    {
        return $this->hasMany(Programa::class, 'idEntidad', 'idEntidad');
    }

    /**
     * Relación 1:N - Una entidad tiene muchos planes
     */
    public function planes(): HasMany
    {
        return $this->hasMany(Plan::class, 'idEntidad', 'idEntidad');
    }

    // RELACIONES CALCULADAS - A través de programas

    /**
     * Obtener todos los proyectos de esta entidad a través de programas
     */
    public function proyectos()
    {
        return $this->hasManyThrough(
            Proyecto::class,
            Programa::class,
            'idEntidad',
            'idPrograma',
            'idEntidad',
            'idPrograma'
        );
    }

    // SCOPES ÚTILES

    /**
     * Entidades activas
     */
    public function scopeActivas($query)
    {
        return $query->where('estado', 'activa');
    }

    /**
     * Entidades por nivel de gobierno
     */
    public function scopePorNivelGobierno($query, $nivel)
    {
        return $query->where('nivelGobierno', $nivel);
    }
}
