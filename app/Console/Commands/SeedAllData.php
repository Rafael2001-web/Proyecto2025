<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed-all {--fresh : Drop all tables and re-run all migrations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed all data for SIPeIP 2.0 system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Iniciando población de datos para SIPeIP 2.0...');

        if ($this->option('fresh')) {
            $this->info('📋 Ejecutando migraciones frescas...');
            $this->call('migrate:fresh');
        }

        $this->info('🌱 Poblando base de datos...');
        $this->call('db:seed');

        $this->info('✅ ¡Datos poblados exitosamente!');
        $this->info('📊 El sistema SIPeIP 2.0 está listo para usar.');
        
        $this->newLine();
        $this->comment('Datos creados:');
        $this->comment('• Usuarios administradores');
        $this->comment('• Entidades gubernamentales');
        $this->comment('• Unidades organizacionales');
        $this->comment('• Objetivos de Desarrollo Sostenible (17 ODS)');
        $this->comment('• Objetivos del Plan Nacional de Desarrollo');
        $this->comment('• Objetivos Estratégicos');
        $this->comment('• Planes de desarrollo');
        $this->comment('• Programas de inversión');
        $this->comment('• Proyectos de inversión pública');
    }
}
