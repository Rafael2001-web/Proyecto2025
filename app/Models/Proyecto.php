<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'sector',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
        'estado',
        'user_id',
        'idPrograma'
    ];

    protected $dates = ['fecha_inicio', 'fecha_fin'];

    // RELACIONES DIRECTAS
    
    /**
     * Relación N:1 - Un proyecto pertenece a un usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación N:1 - Un proyecto pertenece a un programa
     */
    public function programa(): BelongsTo
    {
        return $this->belongsTo(Programa::class, 'idPrograma', 'idPrograma');
    }

    // RELACIONES DE ALINEACIÓN ESTRATÉGICA
    
    /**
     * Relación N:M - Un proyecto contribuye a varios ODS
     */
    public function ods(): BelongsToMany
    {
        return $this->belongsToMany(
            Ods::class,
            'proyecto_ods',
            'proyecto_id',
            'idOds'
        )->withPivot([
            'impacto_esperado',
            'indicadores',
            'nivel_impacto'
        ])->withTimestamps();
    }

    // RELACIONES CALCULADAS - A través de programa
    
    /**
     * Obtener la entidad a través del programa
     */
    public function entidad()
    {
        return $this->hasOneThrough(
            Entidad::class,
            Programa::class,
            'idPrograma',
            'idEntidad',
            'idPrograma',
            'idEntidad'
        );
    }

    /**
     * Obtener el plan a través del programa
     */
    public function plan()
    {
        return $this->hasOneThrough(
            Plan::class,
            Programa::class,
            'idPrograma',
            'idPlan',
            'idPrograma',
            'idPlan'
        );
    }

    /**
     * Obtener la unidad a través del programa y entidad
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
        )->through('entidad');
    }

    // SCOPES ÚTILES
    
    /**
     * Proyectos activos
     */
    public function scopeActivos($query)
    {
        return $query->whereIn('estado', ['en_progreso', 'planificado']);
    }

    /**
     * Proyectos completados
     */
    public function scopeCompletados($query)
    {
        return $query->where('estado', 'completado');
    }

    /**
     * Proyectos por programa
     */
    public function scopePorPrograma($query, $idPrograma)
    {
        return $query->where('idPrograma', $idPrograma);
    }

    /**
     * Proyectos por usuario
     */
    public function scopePorUsuario($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Proyectos por rango de fechas
     */
    public function scopeEntreFechas($query, $fechaInicio, $fechaFin)
    {
        return $query->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
                    ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin]);
    }

    /**
     * Proyectos vigentes
     */
    public function scopeVigentes($query, $fecha = null)
    {
        $fecha = $fecha ?? now();
        return $query->where('fecha_inicio', '<=', $fecha)
                    ->where('fecha_fin', '>=', $fecha);
    }

    // ACCESSORS Y MUTATORS
    
    /**
     * Calcular duración del proyecto en días
     */
    public function getDuracionAttribute()
    {
        if (!$this->fecha_inicio || !$this->fecha_fin) return null;
        
        return $this->fecha_inicio->diffInDays($this->fecha_fin);
    }

    /**
     * Verificar si el proyecto está vencido
     */
    public function getVencidoAttribute()
    {
        return $this->fecha_fin < now() && $this->estado !== 'completado';
    }

    /**
     * Calcular progreso basado en fechas (si no hay otro sistema)
     */
    public function getProgresoFechasAttribute()
    {
        if (!$this->fecha_inicio || !$this->fecha_fin) return 0;
        
        $now = now();
        if ($now < $this->fecha_inicio) return 0;
        if ($now > $this->fecha_fin) return 100;
        
        $duracionTotal = $this->fecha_inicio->diffInDays($this->fecha_fin);
        $duracionTranscurrida = $this->fecha_inicio->diffInDays($now);
        
        return round(($duracionTranscurrida / $duracionTotal) * 100, 2);
    }

    /**
     * Formatear presupuesto
     */
    public function getPresupuestoFormateadoAttribute()
    {
        return 'S/ ' . number_format($this->presupuesto, 2);
    }
}
