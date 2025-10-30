<?php

use App\Actions\CategoryDistributionOfPCAction;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductionCost;
use App\Models\ProductionCostProduction;
use Illuminate\Database\Eloquent\Collection;

describe('Action: CategoryDistributionOfPC', function () {

    it('calculates correctly', function (array $production_cost_productions, $expected) {
        //arrange
        $production_cost_productions = createManyProductionCostProduction($production_cost_productions);

        // act
        $distribution = (new CategoryDistributionOfPCAction())->execute($this->production_cost);

        // assert
        expect($distribution)->toBe($expected);
    })->with('distribution_scenarios');


    beforeEach(function () {
        $this->production_cost = ProductionCost::factory()->create(['id' => 1]);
    });

    dataset('distribution_scenarios', [
        '46/31/23' => [
            'production_cost_productions' => [
                ['product' => ['product_category' => ['name' => 'c1']], 'count' => 46, 'production_cost_id' => 1],
                ['product' => ['product_category' => ['name' => 'c2']], 'count' => 31, 'production_cost_id' => 1],
                ['product' => ['product_category' => ['name' => 'c3']], 'count' => 23, 'production_cost_id' => 1],
            ],
            'expected' => [
                'c1' => ['count' => 46, 'percentage' => 46.0],
                'c2' => ['count' => 31, 'percentage' => 31.0],
                'c3' => ['count' => 23, 'percentage' => 23.0],
            ]
        ],
        '50/50' => [
            'production_cost_productions' => [
                ['product' => ['product_category' => ['name' => 'c1']], 'count' => 50, 'production_cost_id' => 1],
                ['product' => ['product_category' => ['name' => 'c2']], 'count' => 50, 'production_cost_id' => 1],
            ],
            'expected' => [
                'c1' => ['count' => 50, 'percentage' => 50.0],
                'c2' => ['count' => 50, 'percentage' => 50.0],
            ]
        ],
        '100/' => [
            'production_cost_productions' => [
                ['product' => ['product_category' => ['name' => 'c1']], 'count' => 100, 'production_cost_id' => 1],
            ],
            'expected' => [
                'c1' => ['count' => 100, 'percentage' => 100.0],
            ]
        ],
        'Product without category' => [
            'production_cost_productions' => [
                ['product' => ['product_category_id' => null], 'count' => 100, 'production_cost_id' => 1],
            ],
            'expected' => [
                'Sem Categoria' => ['count' => 100, 'percentage' => 100.0],
            ]
        ],
        'No Product in Production Cost' => [
            'production_cost_productions' => [],
            'expected' => []
        ],
        'Multiple products in the same category' => [
            'production_cost_productions' => [
                ['product' => ['product_category' => ['name' => 'c1']], 'count' => 40, 'production_cost_id' => 1],
                ['product' => ['product_category' => ['name' => 'c1']], 'count' => 60, 'production_cost_id' => 1],
            ],
            'expected' => [
                'c1' => ['count' => 100, 'percentage' => 100.0],
            ]
        ]
    ]);

});
