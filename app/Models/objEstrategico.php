<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class objEstrategico extends Model
{
    use HasFactory;

    protected $primaryKey = 'idobjEstrategico';
    public $timestamps = false;
    protected $table = 'objEstrategicos';

    protected $fillable = [
        'fechaRegistro',
        'descripcion',
        'estado'
    ];

    protected $dates = ['fechaRegistro'];

    // RELACIONES

    /**
     * Relación N:M - Un objetivo estratégico puede estar en varios planes
     */
    public function planes(): BelongsToMany
    {
        return $this->belongsToMany(
            Plan::class,
            'plan_objetivos_estrategicos',
            'idobjEstrategico',
            'idPlan'
        )->withPivot([
            'prioridad',
            'justificacion'
        ])->withTimestamps();
    }

    /**
     * Relación 1:N - Un objetivo estratégico puede tener múltiples objetivos institucionales
     */
    public function objetivosInstitucionales(): HasMany
    {
        return $this->hasMany(ObjetivoInstitucional::class, 'idobjEstrategico', 'idobjEstrategico');
    }

    // RELACIONES CALCULADAS

    /**
     * Obtener programas relacionados a través de planes
     */
    public function programas()
    {
        return $this->hasManyThrough(
            Programa::class,
            Plan::class,
            'idPlan',
            'idPlan',
            'idobjEstrategico',
            'idPlan'
        )->join('plan_objetivos_estrategicos', 'plan.idPlan', '=', 'plan_objetivos_estrategicos.idPlan')
         ->where('plan_objetivos_estrategicos.idobjEstrategico', $this->idobjEstrategico);
    }

    /**
     * Obtener proyectos relacionados a través de planes y programas
     */
    public function proyectos()
    {
        return Proyecto::whereHas('programa.plan.objetivosEstrategicos', function ($query) {
            $query->where('idobjEstrategico', $this->idobjEstrategico);
        });
    }

    // SCOPES ÚTILES

    /**
     * Objetivos estratégicos activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    /**
     * Objetivos por año de registro
     */
    public function scopePorAno($query, $ano)
    {
        return $query->whereYear('fechaRegistro', $ano);
    }

    /**
     * Buscar en descripción
     */
    public function scopeBuscar($query, $termino)
    {
        return $query->where('descripcion', 'LIKE', "%{$termino}%");
    }

    /**
     * Objetivos por prioridad en planes
     */
    public function scopePorPrioridad($query, $prioridad)
    {
        return $query->whereHas('planes', function ($q) use ($prioridad) {
            $q->wherePivot('prioridad', $prioridad);
        });
    }

    // ACCESSORS

    /**
     * Obtener descripción resumida
     */
    public function getDescripcionResumidaAttribute()
    {
        return strlen($this->descripcion) > 150
            ? substr($this->descripcion, 0, 150) . '...'
            : $this->descripcion;
    }

    /**
     * Contar planes asociados
     */
    public function getPlanesCountAttribute()
    {
        return $this->planes()->count();
    }

    /**
     * Verificar si tiene alta prioridad en algún plan
     */
    public function getEsAltaPrioridadAttribute()
    {
        return $this->planes()
            ->wherePivot('prioridad', 'alta')
            ->exists();
    }

    /**
     * Obtener fecha de registro formateada
     */
    public function getFechaRegistroFormateadaAttribute()
    {
        return $this->fechaRegistro ? $this->fechaRegistro->format('d/m/Y') : null;
    }
}
