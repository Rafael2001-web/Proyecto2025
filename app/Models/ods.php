<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ods extends Model
{
    use HasFactory;

    protected $primaryKey = 'idOds';
    public $timestamps = false;
    protected $table = 'ods';

    protected $fillable = [
        'odsnum',
        'nombre',
        'descripcion'
    ];

    // RELACIONES

    /**
     * Relación N:M - Un ODS puede estar en varios planes
     */
    public function planes(): BelongsToMany
    {
        return $this->belongsToMany(
            Plan::class,
            'plan_ods',
            'idOds',
            'idPlan'
        )->withPivot([
            'porcentaje_contribucion',
            'descripcion_contribucion'
        ])->withTimestamps();
    }

    /**
     * Relación N:M - Un ODS puede recibir contribución de varios proyectos
     */
    public function proyectos(): BelongsToMany
    {
        return $this->belongsToMany(
            Proyecto::class,
            'proyecto_ods',
            'idOds',
            'proyecto_id'
        )->withPivot([
            'impacto_esperado',
            'indicadores',
            'nivel_impacto'
        ])->withTimestamps();
    }

    /**
     * Relación N:M - Un ODS se alinea con múltiples objetivos PND
     */
    public function pnd(): BelongsToMany
    {
        return $this->belongsToMany(
            Pnd::class,
            'pnd_ods_alignment',
            'idOds',
            'idPnd'
        )->withPivot([
            'nivel_alineacion',
            'justificacion'
        ])->withTimestamps();
    }

    /**
     * Relación 1:N - Un ODS puede tener múltiples objetivos institucionales
     */
    public function objetivosInstitucionales(): HasMany
    {
        return $this->hasMany(ObjetivoInstitucional::class, 'idOds', 'idOds');
    }

    // SCOPES ÚTILES

    /**
     * ODS por número
     */
    public function scopePorNumero($query, $numero)
    {
        return $query->where('odsnum', $numero);
    }

    /**
     * Buscar ODS por término
     */
    public function scopeBuscar($query, $termino)
    {
        return $query->where('nombre', 'LIKE', "%{$termino}%")
                    ->orWhere('descripcion', 'LIKE', "%{$termino}%");
    }

    // ACCESSORS

    /**
     * Obtener el número formateado del ODS
     */
    public function getNumeroFormateadoAttribute()
    {
        return 'ODS ' . str_pad($this->odsnum, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Obtener título completo
     */
    public function getTituloCompletoAttribute()
    {
        return $this->numero_formateado . ': ' . $this->nombre;
    }

    /**
     * Calcular total de contribución de planes
     */
    public function getContribucionTotalPlanesAttribute()
    {
        return $this->planes()->sum('plan_ods.porcentaje_contribucion');
    }

    /**
     * Contar proyectos relacionados
     */
    public function getProyectosCountAttribute()
    {
        return $this->proyectos()->count();
    }
}
