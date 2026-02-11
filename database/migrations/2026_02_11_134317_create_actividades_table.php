<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->string('codigo', 50);
            $table->string('nombre');
            $table->string('estadoAct');
            $table->text('descripcion')->nullable();
            $table->string('responsable')->nullable();
            $table->enum('estado', ['PLANIFICADA', 'EN_PROGRESO', 'COMPLETADA'])->default('PLANIFICADA');
            $table->unsignedTinyInteger('prioridad');
            $table->date('fecha_inicio_planificada');
            $table->date('fecha_fin_planificada');
            $table->date('fecha_inicio_real')->nullable();
            $table->date('fecha_fin_real')->nullable();
            $table->unsignedInteger('duracion_planificada_dias')->nullable();
            $table->decimal('avance_planificado', 10, 2)->nullable();
            $table->decimal('avance_real', 10, 2)->nullable();
            $table->integer('variacion_tiempo_dias')->nullable();
            $table->enum('estado_reportado', ['NO_INICIADA', 'EN_RIESGO', 'COMPLETADA'])->default('NO_INICIADA');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
            $table->unique(['proyecto_id', 'codigo']);
            $table->index('proyecto_id');
            $table->index('estado');
            $table->index('estado_reportado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};