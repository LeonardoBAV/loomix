<?php

namespace Database\Seeders;

use App\Models\Shape;
use Illuminate\Database\Seeder;

class ShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shape::factory()->count(10)->create();
    }
}
