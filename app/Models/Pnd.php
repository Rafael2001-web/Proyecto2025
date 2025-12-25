<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pnd extends Model
{
    use HasFactory;

    protected $primaryKey = 'idPnd';
    public $timestamps = false;
    protected $table = 'pnd';

    protected $fillable = [
        'eje',
        'objetivoN',
        'descripcion'
    ];

    // RELACIONES

    /**
     * Relación N:M - Un elemento del PND puede estar en varios planes
     */
    public function planes(): BelongsToMany
    {
        return $this->belongsToMany(
            Plan::class,
            'plan_pnd',
            'idPnd',
            'idPlan'
        )->withPivot([
            'nivel_alineacion',
            'descripcion_alineacion'
        ])->withTimestamps();
    }

    /**
     * Relación N:M - Un objetivo PND se alinea con múltiples ODS
     */
    public function ods(): BelongsToMany
    {
        return $this->belongsToMany(
            Ods::class,
            'pnd_ods_alignment',
            'idPnd',
            'idOds'
        )->withPivot([
            'nivel_alineacion',
            'justificacion'
        ])->withTimestamps();
    }

    /**
     * Relación 1:N - Un PND puede tener múltiples objetivos institucionales
     */
    public function objetivosInstitucionales(): HasMany
    {
        return $this->hasMany(ObjetivoInstitucional::class, 'idPnd', 'idPnd');
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
            'idPnd',
            'idPlan'
        )->join('plan_pnd', 'plan.idPlan', '=', 'plan_pnd.idPlan')
         ->where('plan_pnd.idPnd', $this->idPnd);
    }

    /**
     * Obtener proyectos relacionados a través de planes y programas
     */
    public function proyectos()
    {
        return Proyecto::whereHas('programa.plan.pnd', function ($query) {
            $query->where('idPnd', $this->idPnd);
        });
    }

    // SCOPES ÚTILES

    /**
     * Elementos del PND por eje estratégico
     */
    public function scopePorEje($query, $eje)
    {
        return $query->where('eje', $eje);
    }

    /**
     * Buscar en PND
     */
    public function scopeBuscar($query, $termino)
    {
        return $query->where('objetivoN', 'LIKE', "%{$termino}%")
                    ->orWhere('descripcion', 'LIKE', "%{$termino}%")
                    ->orWhere('eje', 'LIKE', "%{$termino}%");
    }

    /**
     * PND por nivel de alineación
     */
    public function scopePorNivelAlineacion($query, $nivel)
    {
        return $query->whereHas('planes', function ($q) use ($nivel) {
            $q->wherePivot('nivel_alineacion', $nivel);
        });
    }

    /**
     * Obtener ejes únicos
     */
    public function scopeEjesUnicos($query)
    {
        return $query->select('eje')->distinct()->orderBy('eje');
    }

    // ACCESSORS

    /**
     * Obtener título completo del PND
     */
    public function getTituloCompletoAttribute()
    {
        return $this->eje . ' - ' . $this->objetivoN;
    }

    /**
     * Obtener descripción resumida
     */
    public function getDescripcionResumidaAttribute()
    {
        return strlen($this->descripcion) > 200
            ? substr($this->descripcion, 0, 200) . '...'
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
     * Obtener planes con alineación total
     */
    public function getPlanesAlineacionTotalAttribute()
    {
        return $this->planes()
            ->wherePivot('nivel_alineacion', 'total')
            ->count();
    }

    /**
     * Verificar si tiene alineación crítica
     */
    public function getEsAlineacionCriticaAttribute()
    {
        return $this->planes()
            ->wherePivot('nivel_alineacion', 'total')
            ->exists();
    }

    // MÉTODOS ÚTILES

    /**
     * Obtener estadísticas de alineación
     */
    public function getEstadisticasAlineacion()
    {
        return [
            'total' => $this->planes()->wherePivot('nivel_alineacion', 'total')->count(),
            'parcial' => $this->planes()->wherePivot('nivel_alineacion', 'parcial')->count(),
            'indirecta' => $this->planes()->wherePivot('nivel_alineacion', 'indirecta')->count(),
        ];
    }
}

