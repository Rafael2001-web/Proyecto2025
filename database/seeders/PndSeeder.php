<?php

namespace Database\Seeders;

use App\Models\Pnd;
use Illuminate\Database\Seeder;

class PndSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pnd::factory()->count(16)->create();
    }
}