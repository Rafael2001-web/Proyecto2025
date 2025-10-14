<?php

namespace Database\Seeders;

use App\Models\Ods;
use Illuminate\Database\Seeder;

class OdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los 17 ODS oficiales
        for ($i = 1; $i <= 17; $i++) {
            Ods::factory()->create(['odsnum' => $i]);
        }
    }
}
