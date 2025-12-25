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
        Schema::create('objetivos_institucionales', function (Blueprint $table) {
            $table->id('idObjInstitucional');
            $table->unsignedBigInteger('idPnd');
            $table->unsignedBigInteger('idOds');
            $table->unsignedBigInteger('idobjEstrategico');
            $table->string('nivel_alineacion')->default('Alto'); // Alto, Medio, Bajo
            $table->text('justificacion')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('idPnd')->references('idPnd')->on('pnd')->onDelete('cascade');
            $table->foreign('idOds')->references('idOds')->on('ods')->onDelete('cascade');
            $table->foreign('idobjEstrategico')->references('idobjEstrategico')->on('objestrategicos')->onDelete('cascade');

            // Evitar duplicados en la combinación de las 3 tablas
            $table->unique(['idPnd', 'idOds', 'idobjEstrategico'], 'unique_obj_institucional');

            // Índices para mejorar consultas
            $table->index('idPnd');
            $table->index('idOds');
            $table->index('idobjEstrategico');
            $table->index('nivel_alineacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivos_institucionales');
    }
};
