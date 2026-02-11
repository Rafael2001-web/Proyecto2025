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
        Schema::create('actividad_objetivos_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actividad_id');
            $table->unsignedBigInteger('idobjEstrategico');
            $table->timestamps();

            $table->foreign('actividad_id')->references('id')->on('actividades')->onDelete('cascade');
            $table->foreign('idobjEstrategico')->references('idobjEstrategico')->on('objEstrategicos')->onDelete('cascade');
            $table->unique(['actividad_id', 'idobjEstrategico'], 'unique_actividad_objetivo');
            $table->index('actividad_id');
            $table->index('idobjEstrategico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividad_objetivos_estrategicos');
    }
};