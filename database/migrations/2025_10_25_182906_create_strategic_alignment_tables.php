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
        // 1. Tabla pivot: Plan - ODS
        Schema::create('plan_ods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPlan');
            $table->unsignedBigInteger('idOds');
            $table->decimal('porcentaje_contribucion', 5, 2)->default(0)->comment('Porcentaje de contribución al ODS (0-100)');
            $table->text('descripcion_contribucion')->nullable()->comment('Descripción específica de la contribución');
            $table->timestamps();
            
            // Claves foráneas
            $table->foreign('idPlan')->references('idPlan')->on('plan')->onDelete('cascade');
            $table->foreign('idOds')->references('idOds')->on('ods')->onDelete('cascade');
            
            // Índices y restricciones
            $table->unique(['idPlan', 'idOds']);
            $table->index('idPlan');
            $table->index('idOds');
        });

        // 2. Tabla pivot: Plan - Objetivos Estratégicos
        Schema::create('plan_objetivos_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPlan');
            $table->unsignedBigInteger('idobjEstrategico');
            $table->enum('prioridad', ['alta', 'media', 'baja'])->default('media');
            $table->text('justificacion')->nullable()->comment('Justificación de la alineación');
            $table->timestamps();
            
            // Claves foráneas
            $table->foreign('idPlan')->references('idPlan')->on('plan')->onDelete('cascade');
            $table->foreign('idobjEstrategico')->references('idobjEstrategico')->on('objEstrategicos')->onDelete('cascade');
            
            // Índices y restricciones
            $table->unique(['idPlan', 'idobjEstrategico'], 'unique_plan_objetivo');
            $table->index('idPlan');
            $table->index('idobjEstrategico');
        });

        // 3. Tabla pivot: Plan - PND
        Schema::create('plan_pnd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPlan');
            $table->unsignedBigInteger('idPnd');
            $table->enum('nivel_alineacion', ['total', 'parcial', 'indirecta'])->default('parcial');
            $table->text('descripcion_alineacion')->nullable()->comment('Descripción de cómo se alinea con el PND');
            $table->timestamps();
            
            // Claves foráneas
            $table->foreign('idPlan')->references('idPlan')->on('plan')->onDelete('cascade');
            $table->foreign('idPnd')->references('idPnd')->on('pnd')->onDelete('cascade');
            
            // Índices y restricciones
            $table->unique(['idPlan', 'idPnd']);
            $table->index('idPlan');
            $table->index('idPnd');
        });

        // 4. Tabla pivot: Proyecto - ODS
        Schema::create('proyecto_ods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('idOds');
            $table->text('impacto_esperado')->nullable()->comment('Descripción del impacto esperado');
            $table->text('indicadores')->nullable()->comment('Indicadores de medición del impacto');
            $table->enum('nivel_impacto', ['alto', 'medio', 'bajo'])->default('medio');
            $table->timestamps();
            
            // Claves foráneas
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('idOds')->references('idOds')->on('ods')->onDelete('cascade');
            
            // Índices y restricciones
            $table->unique(['proyecto_id', 'idOds']);
            $table->index('proyecto_id');
            $table->index('idOds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar tablas en orden inverso
        Schema::dropIfExists('proyecto_ods');
        Schema::dropIfExists('plan_pnd');
        Schema::dropIfExists('plan_objetivos_estrategicos');
        Schema::dropIfExists('plan_ods');
    }
};
