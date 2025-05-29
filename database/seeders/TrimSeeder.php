<?php

namespace Database\Seeders;

use App\Models\Trim;
use Illuminate\Database\Seeder;

class TrimSeeder extends Seeder
{
    public function run(): void
    {
        Trim::factory()->count(20)->create();
    }
} 