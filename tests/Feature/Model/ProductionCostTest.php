<?php

use App\Models\Product;
use App\Models\ProductionCost;
use Illuminate\Database\Eloquent\Collection;

describe('getTotalWeight', function () {
    
    it('calculates correctly', function (array $products_data, array $counts, float $expected) {
        //arrange
        $products = createProducts($products_data);
        $production_cost_productions_data = buildProductionCostProductionsData($this->production_cost, $products, $counts);
        createProductionCostProductions($production_cost_productions_data);

        // act
        $total_weight = $this->production_cost->getTotalWeight();
        
        // assert
        expect($total_weight)->toBe($expected); 
    })->with('scenarios');

    dataset('scenarios', [
        /*'empty' => [//obs: test in any production weight never be 0
            'production_weights' => [null],
            'counts' => [],
            'expected' => 0.0,
        ],
        /*'zero production weight' => [ //obs: test in any production weight never be 0
            'production_weights' => [0],
            'counts' => [10],
            'expected' => 0.0,
        ],*/
        'single_product' => [
            'products_data' => [['production_weight' => 2.5]],
            'counts' => [10],
            'expected' => 25.0,
        ],
        'multiple_products' => [
            'products_data' => [
                ['production_weight' => 2.5],
                ['production_weight' => 1.5],
                ['production_weight' => 0.5]],
            'counts' => [10, 5, 20],
            'expected' => 42.5,
        ],
        'empty_list_of_production_cost_productions' => [
            'products_data' => [],
            'counts' => [],
            'expected' => 0.0,
        ],
    ]);

    beforeEach(function () {
        $this->production_cost = ProductionCost::factory()->create();
    });

    function buildProductionCostProductionsData(ProductionCost $production_cost, Collection $products, array $counts): array
    {
        return collect($products)->map(function (Product $product, $index) use ($production_cost, $counts) {
            return [
                'production_cost_id' => $production_cost->id,
                'product_id' => $product->id,
                'count' => $counts[$index],
            ];
        })->toArray();
    }

}); 