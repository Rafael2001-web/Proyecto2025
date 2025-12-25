<?php

namespace Database\Seeders;

use App\Models\plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        plan::factory()->count(15)->create();
    }
}