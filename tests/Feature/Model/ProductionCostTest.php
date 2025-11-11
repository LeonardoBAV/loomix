<?php

use App\Models\ProductionCost;

describe('Model ProductionCost: getTotalWeight', function () {

    beforeEach(function () {
        $this->production_cost = ProductionCost::factory()->create(['id' => 1]);
    });

    it('calculates correctly', function (array $production_cost_productions, $expected) {
        // arrange
        $production_cost_productions = createManyProductionCostProduction($production_cost_productions);

        // act
        $total_weight = $this->production_cost->getTotalWeight();

        // assert
        expect($total_weight)->toBe($expected);
    })->with('scenarios');

    it('true', function () {
        expect(false)->toBeTrue();
    });

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
            'production_cost_productions' => [['product' => ['production_weight' => 2.5], 'count' => 10, 'production_cost_id' => 1]],
            'expected' => 25.0,
        ],
        'multiple_products' => [
            'production_cost_productions' => [
                ['product' => ['production_weight' => 2.5], 'count' => 10, 'production_cost_id' => 1],
                ['product' => ['production_weight' => 1.5], 'count' => 5, 'production_cost_id' => 1],
                ['product' => ['production_weight' => 0.5], 'count' => 20, 'production_cost_id' => 1],
            ],
            'expected' => 42.5,
        ],
        'empty_list_of_production_cost_productions' => [
            'production_cost_productions' => [],
            'expected' => 0.0,
        ],

    ]);

});
