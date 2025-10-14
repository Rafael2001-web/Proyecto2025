<?php

namespace Database\Seeders;

use App\Models\objEstrategico;
use Illuminate\Database\Seeder;

class ObjEstrategicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        objEstrategico::factory()->count(10)->create();
    }
}