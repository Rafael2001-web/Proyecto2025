<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObjetivoInstitucional extends Model
{
    use HasFactory;

    protected $primaryKey = 'idObjInstitucional';
    protected $table = 'objetivos_institucionales';

    protected $fillable = [
        'idPnd',
        'idOds',
        'idobjEstrategico',
        'nivel_alineacion',
        'justificacion'
    ];

    // RELACIONES

    /**
     * Relación N:1 - Un objetivo institucional pertenece a un elemento del PND
     */
    public function pnd(): BelongsTo
    {
        return $this->belongsTo(Pnd::class, 'idPnd', 'idPnd');
    }

    /**
     * Relación N:1 - Un objetivo institucional pertenece a un ODS
     */
    public function ods(): BelongsTo
    {
        return $this->belongsTo(Ods::class, 'idOds', 'idOds');
    }

    /**
     * Relación N:1 - Un objetivo institucional pertenece a un objetivo estratégico
     */
    public function objetivoEstrategico(): BelongsTo
    {
        return $this->belongsTo(objEstrategico::class, 'idobjEstrategico', 'idobjEstrategico');
    }

    // SCOPES

    /**
     * Scope para filtrar por nivel de alineación
     */
    public function scopeNivelAlineacion($query, $nivel)
    {
        return $query->where('nivel_alineacion', $nivel);
    }

    /**
     * Scope para obtener alineaciones de alta prioridad
     */
    public function scopeAltaPrioridad($query)
    {
        return $query->where('nivel_alineacion', 'Alto');
    }

    // ACCESSORS

    /**
     * Obtener información completa del objetivo institucional
     */
    public function getDescripcionCompletaAttribute()
    {
        return sprintf(
            'OI: %s - PND: %s - ODS: %s',
            $this->objetivoEstrategico->descripcion ?? 'N/A',
            $this->pnd->descripcion ?? 'N/A',
            $this->ods->nombre ?? 'N/A'
        );
    }
}
