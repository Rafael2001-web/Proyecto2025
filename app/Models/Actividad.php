<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Entidad extends Model
{
    use HasFactory;

    protected $primaryKey = 'idActividad';
    public $timestamps = false;
    protected $table = 'entidad';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'responsable_id',
        'prioridad',
        'estado_actividad',
        'estado_registro',
        'fecha_inicio_planificada',
        'fecha_fin_planificada',
        'fecha_inicio_real',
        'fecha_fin_real',
        'duracion_planificada',
        'avance_planificado',
        'avance_real',

    ];

    

}