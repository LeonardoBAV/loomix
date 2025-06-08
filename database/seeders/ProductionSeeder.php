<?php

namespace Database\Seeders;

use App\Models\Production;
use App\Models\ProductionItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar 20 produções
        Production::factory(20)->create()->each(function ($production) {
            // Para cada produção, criar entre 1 e 5 itens de produção
            $products = Product::inRandomOrder()->limit(rand(1, 5))->get();
            
            foreach ($products as $product) {
                ProductionItem::factory()->create([
                    'production_id' => $production->id,
                    'product_id' => $product->id,
                    'count' => rand(1, 100),
                ]);
            }
        });
    }
} 