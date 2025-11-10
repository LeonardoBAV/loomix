<?php

namespace Database\Seeders;

use App\Models\FabricShape;
use Illuminate\Database\Seeder;

class FabricShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FabricShape::factory()->count(15)->create();
    }
}
