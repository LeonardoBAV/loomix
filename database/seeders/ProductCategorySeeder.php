<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Blusas',
            'Calças',
            'Vestidos',
            'Saias',
            'Shorts',
            'Jaquetas',
            'Macacões',
            'Conjuntos',
        ];

        foreach ($categories as $category) {
            ProductCategory::firstOrCreate(['name' => $category]);
        }
    }
}

