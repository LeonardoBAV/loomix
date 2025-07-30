<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Color;
use App\Models\Cutter;
use App\Models\Production;
use App\Models\ProductionGrid;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        // Create sizes
        Size::factory()->count(6)->create();
        
        // Create colors
        Color::factory()->count(8)->create();
        
        // Create cutters
        Cutter::factory()->count(5)->create();
        
        // Create clients
        Client::factory()->count(10)->create();
        
        // Create productions with grids
        Production::factory()
            ->count(15)
            ->has(
                ProductionGrid::factory()
                    ->count(3)
            )
            ->create();
    }
} 