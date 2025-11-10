<?php

namespace Database\Seeders;

use App\Models\ProductArrangement;
use Illuminate\Database\Seeder;

class ProductArrangementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar um arranjo padrão
        ProductArrangement::firstOrCreate(
            ['id' => 1],
            ['default' => true]
        );

        // Criar alguns arranjos adicionais
        ProductArrangement::factory(3)->create([
            'default' => false,
        ]);
    }
}
