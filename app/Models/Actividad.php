<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'proyecto_id',
        'codigo',
        'nombre',
        'descripcion',
        'responsable',
        'estado',
        'estadoAct',
        'prioridad',
        'fecha_inicio_planificada',
        'fecha_fin_planificada',
        'fecha_inicio_real',
        'fecha_fin_real',
        'duracion_planificada_dias',
        'avance_planificado',
        'avance_real',
        'variacion_tiempo_dias',
        'estado_reportado',
        'activo'
    ];

    protected $casts = [
        'fecha_inicio_planificada' => 'date',
        'fecha_fin_planificada' => 'date',
        'fecha_inicio_real' => 'date',
        'fecha_fin_real' => 'date',
        'avance_planificado' => 'decimal:2',
        'avance_real' => 'decimal:2',
        'activo' => 'boolean'
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'id');
    }

    public function objetivosEstrategicos(): BelongsToMany
    {
        return $this->belongsToMany(
            objEstrategico::class,
            'actividad_objetivos_estrategicos',
            'actividad_id',
            'idobjEstrategico'
        )->withTimestamps();
    }

    public function auditorias(): HasMany
    {
        return $this->hasMany(ActividadAuditoria::class, 'actividad_id', 'id');
    }
}