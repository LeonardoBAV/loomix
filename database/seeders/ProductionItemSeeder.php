<?php

namespace Database\Seeders;

use App\Models\ProductionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Este seeder pode ser usado independentemente
        // Cria 100 itens de produção aleatórios
        ProductionItem::factory(100)->create();
    }
} 