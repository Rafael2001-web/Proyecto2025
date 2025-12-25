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
        // 1. Entidad -> Unidad (N:1)
        Schema::table('entidad', function (Blueprint $table) {
            $table->unsignedBigInteger('idUnidad')->nullable()->after('idEntidad');
            $table->foreign('idUnidad')->references('idUnidad')->on('unidad')->onDelete('set null');
            $table->index('idUnidad');
        });

        // 2. Programa -> Plan (N:1)
        Schema::table('programa', function (Blueprint $table) {
            $table->unsignedBigInteger('idPlan')->nullable()->after('idEntidad');
            $table->foreign('idPlan')->references('idPlan')->on('plan')->onDelete('cascade');
            $table->index('idPlan');
        });

        // 3. Proyecto -> Programa (N:1)
        Schema::table('proyectos', function (Blueprint $table) {
            $table->unsignedBigInteger('idPrograma')->nullable()->after('user_id');
            $table->foreign('idPrograma')->references('idPrograma')->on('programa')->onDelete('set null');
            $table->index('idPrograma');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir en orden inverso para evitar errores de FK
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropForeign(['idPrograma']);
            $table->dropIndex(['idPrograma']);
            $table->dropColumn('idPrograma');
        });

        Schema::table('programa', function (Blueprint $table) {
            $table->dropForeign(['idPlan']);
            $table->dropIndex(['idPlan']);
            $table->dropColumn('idPlan');
        });

        Schema::table('entidad', function (Blueprint $table) {
            $table->dropForeign(['idUnidad']);
            $table->dropIndex(['idUnidad']);
            $table->dropColumn('idUnidad');
        });
    }
};
