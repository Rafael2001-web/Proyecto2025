<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Basado en el documento CASOS_DE_USO.md - Sistema de roles específicos por CRUD
     */
    public function run(): void
    {
        // ==================================================================================
        // CREAR LOS 10 ROLES ESPECÍFICOS DEL SISTEMA SIPEIP 2.0
        // ==================================================================================

        $adminRole = Role::firstOrCreate(['name' => 'Administrador del Sistema']);
        $tecnicoPlanificacionRole = Role::firstOrCreate(['name' => 'Técnico de Planificación']);
        $planificadorInstitucionalRole = Role::firstOrCreate(['name' => 'Planificador Institucional']);
        $revisorInstitucionalRole = Role::firstOrCreate(['name' => 'Revisor Institucional']);
        $autoridadValidanteRole = Role::firstOrCreate(['name' => 'Autoridad Validante']);
        $supervisorGeneralRole = Role::firstOrCreate(['name' => 'Supervisor General']);
        $userRole = Role::firstOrCreate(['name' => 'Usuario Externo']);
        $auditorRole = Role::firstOrCreate(['name' => 'Auditor']);

        // ==================================================================================
        // DEFINIR TODOS LOS PERMISOS DEL SISTEMA
        // ==================================================================================

        $permissions = [
            // ===== DASHBOARD =====
            'view dashboard',

            // ===== USUARIOS (Administrador del Sistema) =====
            'manage usuarios',
            'view usuarios',
            'create usuarios',
            'edit usuarios',
            'delete usuarios',

            // ===== ROLES (Administrador del Sistema) =====
            'manage roles',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'manage permissions',
            'view permissions',

            // ===== ENTIDADES  =====
            'manage entidades',
            'view entidades',
            'create entidades',
            'edit entidades',
            'delete entidades',
            'generate report entidades',

            // ===== UNIDADES  =====
            'manage unidades',
            'view unidades',
            'create unidades',
            'edit unidades',
            'delete unidades',
            'generate report unidades',

            // ===== ODS  =====
            'manage ods',
            'view ods',
            'create ods',
            'edit ods',
            'delete ods',
            'generate report ods',

            // ===== OBJETIVOS ESTRATÉGICOS  =====
            'manage objetivos_estrategicos',
            'view objetivos_estrategicos',
            'create objetivos_estrategicos',
            'edit objetivos_estrategicos',
            'delete objetivos_estrategicos',
            'generate report objetivos_estrategicos',

            // ===== PND  =====
            'manage pnd',
            'view pnd',
            'create pnd',
            'edit pnd',
            'delete pnd',
            'generate report pnd',

            // ===== ALINEACIÓN ESTRATÉGICA - OBJETIVOS INSTITUCIONALES =====
            'manage strategic alignment',
            'view strategic alignment',
            'create strategic alignment',
            'edit strategic alignment',
            'delete strategic alignment',
            'generate report strategic alignment',
            'generate report objetivos_institucionales',

            // ===== PLANES (Gestor de Planes) =====
            'manage planes',
            'view planes',
            'create planes',
            'edit planes',
            'cambiar estado planes',
            'delete planes',
            'generate report planes',

            // ===== PROGRAMAS  =====
            'manage programas',
            'view programas',
            'create programas',
            'edit programas',
            'delete programas',
            'generate report programas',

            // ===== PROYECTOS  =====
            'manage proyectos',
            'view proyectos',
            'create proyectos',
            'edit proyectos',
            'delete proyectos',
            'generate report proyectos',

            // ===== REPORTES Y SUPERVISIÓN =====
            'generate reports',
            'view all_modules', // Para supervisor general
        ];

        // Crear todos los permisos
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ==================================================================================
        // ASIGNAR PERMISOS POR ROL - SEGÚN CASOS DE USO
        // ==================================================================================

        // 👑 ADMINISTRADOR DEL SISTEMA
        // ✅ CRUD COMPLETO: Usuarios
        // 👀 SOLO LECTURA: Todos los demás CRUDs (supervisión)
        $adminRole->givePermissionTo([
            'view dashboard',
            // Gestión completa de usuarios
            'manage usuarios',
            'manage roles',
            // Solo lectura de todos los demás módulos (supervisión)
            'manage entidades',
            'manage unidades',
        ]);

        // 🎯 TÉCNICO DE PLANIFICACIÓN
        // ✅ CRUD COMPLETO: Programas, Planes y Alineación Estratégica (Objetivos Institucionales)
        // 👀 SOLO LECTURA: Ninguno
        $tecnicoPlanificacionRole->givePermissionTo([
            'view dashboard',
            'manage strategic alignment',
            'manage planes',
            'manage programas',
    
        ]);

        // 🎯 PLANIFICADOR INSTITUCIONAL
        // ✅ CRUD COMPLETO: Planes, Proyectos
        // 👀 SOLO LECTURA:
        $planificadorInstitucionalRole->givePermissionTo([
            'view dashboard',
            'manage planes',
            'manage proyectos',
        ]);

        // 🏛️ REVISOR INSTITUCIONAL
        // ✅ REVISIÓN Y APROBACIÓN DE PLANES
        // CRUD COMPLETO: PND, ODS, Objetivos Estratégicos
        $revisorInstitucionalRole->givePermissionTo([
            'view planes',
            'cambiar estado planes',
            'manage pnd',
            'manage ods',
            'manage objetivos_estrategicos',
            'manage proyectos',
        ]);

        // AUTORIDAD VALIDANTE
        // ✅ REVISIÓN Y APROBACIÓN DE PLANES
        $autoridadValidanteRole->givePermissionTo([
            'view planes',
            'cambiar estado planes',
        ]);

        // 👁️ SUPERVISOR GENERAL
        // ❌ NINGÚN CRUD COMPLETO
        // 👀 SOLO LECTURA: TODOS los CRUDs menos usuarios
        $supervisorGeneralRole->givePermissionTo([
            'view dashboard',
            'view all_modules',
            // Solo lectura de todos los módulos
            'view entidades',
            'view unidades',
            'view ods',
            'view objetivos_estrategicos',
            'view pnd',
            'view strategic alignment',
            'view planes',
            'view programas',
            'view proyectos',
        ]);

        // USUARIO EXTERNO
        // ❌ NINGÚN CRUD COMPLETO
        // CREACIÓN: Planes,
        // 👀 SOLO LECTURA: TODOS los CRUDs + Reportes
        $userRole->givePermissionTo([
            'view dashboard',
            // Solo lectura de todos los módulos
            'manage planes',
            'view usuarios',
            'view entidades',
            'view ods',
            'view objetivos_estrategicos',
            'view pnd',
            'view planes',
            'create planes',
            'view programas',
            'view proyectos',
            // Acceso completo a reportes
            'generate reports',
        ]);

        // 🕵️ AUDITOR
        // ❌ NINGÚN CRUD COMPLETO
        // 👀 SOLO LECTURA: TODOS los CRUDs menos Usuarios + Reportes
        $auditorRole->givePermissionTo([
            'view dashboard',
            // Solo lectura de todos los módulos menos usuarios
            'view entidades',
            'view unidades',
            'view ods',
            'view objetivos_estrategicos',
            'view pnd',
            'view strategic alignment',
            'view planes',
            'view programas',
            'view proyectos',
            // Acceso completo a reportes
            'generate reports',
            'generate report objetivos_institucionales',
        ]);

        // ==================================================================================
        // BUSCAR USUARIO ADMINISTRADOR POR DEFECTO
        // ==================================================================================

        $adminUser = User::where('email', 'admin@example.com')->first();
        $adminUser->assignRole($adminRole);

        // ==================================================================================
        // USUARIOS DE EJEMPLO PARA CADA ROL
        // ==================================================================================

        $users = [
            [
                'name' => 'Luis Fernández',
                'email' => 'luis.fernandez@sipeip.gob.pe',
                'role' => $tecnicoPlanificacionRole
            ],
            [
                'name' => 'Patricia Vargas',
                'email' => 'patricia.vargas@sipeip.gob.pe',
                'role' => $supervisorGeneralRole
            ],
            [
                'name' => 'Javier Ramírez',
                'email' => 'javier.ramirez@sipeip.gob.pe',
                'role' => $userRole
            ],
            [
                'name' => 'Jorge Castillo',
                'email' => 'jorge.castillo@sipeip.gob.pe',
                'role' => $auditorRole
            ],

            [
                'name' => 'Carlos Yaguana',
                'email' => 'carlos.yaguana@sipeip.gob.pe',
                'role' => $revisorInstitucionalRole
            ],

            [
                'name' => 'Miguel Granda',
                'email' => 'miguel.granda@sipeip.gob.pe',
                'role' => $autoridadValidanteRole
            ],

            [
                'name' => 'Luis Duarte',
                'email' => 'luis.duarte@sipeip.gob.pe',
                'role' => $planificadorInstitucionalRole
            ],


        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate([
                'email' => $userData['email']
            ], [
                'name' => $userData['name'],
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]);

            $user->assignRole($userData['role']);
        }

        $this->command->info('✅ Roles y permisos del Sistema SIPEIP 2.0 creados exitosamente');
        $this->command->info('📋 12 roles específicos con permisos granulares');
        $this->command->info('👥 12 usuarios de ejemplo creados (admin + 11 especialistas)');
        $this->command->info('🔑 Contraseña por defecto: password123 (admin: admin123)');
    }
}