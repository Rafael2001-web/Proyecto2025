<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Plan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idPlan';
    public $timestamps = false;
    protected $table = 'plan';

    protected $fillable = [
        'codigo',
        'nombre',
        'idEntidad',
        'presupuesto',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    protected $dates = ['fecha_inicio', 'fecha_fin'];

    protected static function booted()
    {
        static::creating(function ($plan) {
            if (empty($plan->codigo)) {
                // Genera un código único. Ejemplo: PLN-<5 caracteres aleatorios>
                do {
                    $codigo = 'PLN-' . strtoupper(Str::random(5));
                } while (self::where('codigo', $codigo)->exists());

                $plan->codigo = $codigo;
            }
        });
    }

    // RELACIONES DIRECTAS

    /**
     * Relación N:1 - Un plan pertenece a una entidad
     */
    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class, 'idEntidad', 'idEntidad');
    }

    /**
     * Relación 1:N - Un plan tiene muchos programas
     */
    public function programas(): HasMany
    {
        return $this->hasMany(Programa::class, 'idPlan', 'idPlan');
    }

    // RELACIONES DE ALINEACIÓN ESTRATÉGICA (Many-to-Many)

    /**
     * Relación N:M - Un plan se alinea con varios ODS
     */
    public function ods(): BelongsToMany
    {
        return $this->belongsToMany(
            Ods::class,
            'plan_ods',
            'idPlan',
            'idOds'
        )->withPivot([
            'porcentaje_contribucion',
            'descripcion_contribucion'
        ])->withTimestamps();
    }

    /**
     * Relación N:M - Un plan tiene varios objetivos estratégicos
     */
    public function objetivosEstrategicos(): BelongsToMany
    {
        return $this->belongsToMany(
            objEstrategico::class,
            'plan_objetivos_estrategicos',
            'idPlan',
            'idobjEstrategico'
        )->withPivot([
            'prioridad',
            'justificacion'
        ])->withTimestamps();
    }

    /**
     * Relación N:M - Un plan se alinea con varios elementos del PND
     */
    public function pnd(): BelongsToMany
    {
        return $this->belongsToMany(
            Pnd::class,
            'plan_pnd',
            'idPlan',
            'idPnd'
        )->withPivot([
            'nivel_alineacion',
            'descripcion_alineacion'
        ])->withTimestamps();
    }

    // RELACIONES CALCULADAS

    /**
     * Obtener todos los proyectos del plan a través de programas
     */
    public function proyectos()
    {
        return $this->hasManyThrough(
            Proyecto::class,
            Programa::class,
            'idPlan',
            'idPrograma',
            'idPlan',
            'idPrograma'
        );
    }

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

    // SCOPES ÚTILES

    /**
     * Planes activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    /**
     * Planes por entidad
     */
    public function scopePorEntidad($query, $idEntidad)
    {
        return $query->where('idEntidad', $idEntidad);
    }

    /**
     * Planes vigentes (entre fechas)
     */
    public function scopeVigentes($query, $fecha = null)
    {
        $fecha = $fecha ?? now();
        return $query->where('fecha_inicio', '<=', $fecha)
                    ->where('fecha_fin', '>=', $fecha);
    }

    // ACCESSORS Y MUTATORS

    /**
     * Calcular el progreso del plan basado en proyectos
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
     * Verificar si el plan está vencido
     */
    public function getVencidoAttribute()
    {
        return $this->fecha_fin < now();
    }
}
