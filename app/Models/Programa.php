<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programa extends Model
{
    use HasFactory;

    protected $primaryKey = 'idPrograma';
    protected $table = 'programa';

    protected $fillable = [
        'idEntidad',
        'idPlan',
        'nombre',
        'descripcion',
    ];

    // RELACIONES DIRECTAS
    
    /**
     * Relación N:1 - Un programa pertenece a una entidad
     */
    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class, 'idEntidad', 'idEntidad');
    }

    /**
     * Relación N:1 - Un programa pertenece a un plan
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'idPlan', 'idPlan');
    }

    /**
     * Relación 1:N - Un programa tiene muchos proyectos
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class, 'idPrograma', 'idPrograma');
    }

    // RELACIONES CALCULADAS
    
    /**
     * Obtener la unidad organizacional a través de la entidad
     */
    public function unidad()
    {
        return $this->hasOneThrough(
            Unidad::class,
            Entidad::class,
            'idEntidad',
            'idUnidad',
            'idEntidad',
            'idUnidad'
        );
    }

    /**
     * Obtener los ODS relacionados a través del plan
     */
    public function ods()
    {
        return $this->hasManyThrough(
            Ods::class,
            Plan::class,
            'idPlan',
            'idOds',
            'idPlan',
            'idPlan'
        )->join('plan_ods', 'ods.idOds', '=', 'plan_ods.idOds');
    }

    // SCOPES ÚTILES
    
    /**
     * Programas activos
     */
    public function scopeActivos($query)
    {
        return $query->whereHas('plan', function ($q) {
            $q->where('estado', 'activo');
        });
    }

    /**
     * Programas por entidad
     */
    public function scopePorEntidad($query, $idEntidad)
    {
        return $query->where('idEntidad', $idEntidad);
    }

    /**
     * Programas por plan
     */
    public function scopePorPlan($query, $idPlan)
    {
        return $query->where('idPlan', $idPlan);
    }

    // ACCESSORS
    
    /**
     * Calcular el progreso del programa basado en proyectos
     */
    public function getProgresoAttribute()
    {
        $proyectosTotal = $this->proyectos()->count();
        if ($proyectosTotal === 0) return 0;
        
        $proyectosCompletados = $this->proyectos()
            ->where('estado', 'completado')
            ->count();
            
        return round(($proyectosCompletados / $proyectosTotal) * 100, 2);
    }

    /**
     * Calcular el presupuesto total del programa
     */
    public function getPresupuestoTotalAttribute()
    {
        return $this->proyectos()->sum('presupuesto');
    }
}