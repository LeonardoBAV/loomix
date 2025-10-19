<?php

use App\Actions\CategoryDistributionOfPCAction;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductionCost;
use App\Models\ProductionCostProduction;



it('calculates correctly', function ($product_distributions, $expected) {
    //arrange
    $production_cost = ProductionCost::first();
    createProductionCostProduction($production_cost, $product_distributions);

    // act
    $distribution = (new CategoryDistributionOfPCAction())->execute($production_cost);

    // assert
    expect($distribution)->toBe($expected);
    
})->with('distribution_scenarios');


it('no products in production cost', function () {
    //arrange
    $production_cost = ProductionCost::first();

    // act
    $distribution = (new CategoryDistributionOfPCAction())->execute($production_cost);

    // assert
    expect($distribution)->toBeEmpty();
    
});

it('products without category', function ($product_distributions, $expected) {
    // arrange
    $production_cost = ProductionCost::first();
    createProductionCostProduction($production_cost, $product_distributions);

    // act
    $distribution = (new CategoryDistributionOfPCAction())->execute($production_cost);

    // assert
    expect($distribution)->toBe($expected);

})->with('product_without_category');

it('multiple products in the same category', function ($product_distributions, $expected) {
    // arrange
    $production_cost = ProductionCost::first();
    createProductionCostProduction($production_cost, $product_distributions);

    // act
    $distribution = (new CategoryDistributionOfPCAction())->execute($production_cost);

    // ASSERT
    expect($distribution)->toBe($expected);
})->with('multiple_products_in_the_same_category');


beforeEach(function () {
    $this->production_cost = ProductionCost::factory()->create(['id' => 1]);
    
    $this->category_1 = ProductCategory::factory()->create(['name' => 'c1']);
    $this->category_2 = ProductCategory::factory()->create(['name' => 'c2']);
    $this->category_3 = ProductCategory::factory()->create(['name' => 'c3']);
    
    Product::factory()->create(['id' => 1, 'product_category_id' => $this->category_1->id]);
    Product::factory()->create(['id' => 2, 'product_category_id' => $this->category_2->id]);
    Product::factory()->create(['id' => 3, 'product_category_id' => $this->category_3->id]);
    Product::factory()->create(['id' => 4, 'product_category_id' => $this->category_1->id]);
    Product::factory()->create(['id' => 5, 'product_category_id' => null]);
});

dataset('distribution_scenarios', [
    '50/50' => [
        'product_distributions' => [
            ['product' => '1', 'count' => 50],
            ['product' => '2', 'count' => 50],
        ],
        'expected' => [
            'c1' => ['count' => 50, 'percentage' => 50.0],
            'c2' => ['count' => 50, 'percentage' => 50.0],
        ]
    ],
    '70/30' => [
        'product_distributions' => [
            ['product' => '1', 'count' => 70],
            ['product' => '2', 'count' => 30],
        ],
        'expected' => [
            'c1' => ['count' => 70, 'percentage' => 70.0],
            'c2' => ['count' => 30, 'percentage' => 30.0],
        ]
    ],
    '33/33/34' => [
        'product_distributions' => [
            ['product' => '1', 'count' => 34],
            ['product' => '2', 'count' => 33],
            ['product' => '3', 'count' => 33],
        ],
        'expected' => [
            'c1' => ['count' => 34, 'percentage' => 34.0],
            'c2' => ['count' => 33, 'percentage' => 33.0],
            'c3' => ['count' => 33, 'percentage' => 33.0],
        ]
    ]
]);

dataset('product_without_category', [
    '100% without category' => [
        'product_distributions' => [
            ['product' => 5, 'count' => 100]
        ],
        'expected' => [
            'Sem Categoria' => ['count' => 100, 'percentage' => 100.0],
        ]
    ]
]);

dataset('multiple_products_in_the_same_category', [
    '100% without category' => [
        'product_distributions' => [
            ['product' => 1, 'count' => 40],
            ['product' => 4, 'count' => 60]
        ],
        'expected' => [
            'c1' => ['count' => 100, 'percentage' => 100.0],
        ]
    ]
]);

function createProductionCostProduction($production_cost, $product_distributions){
    
    foreach ($product_distributions as $product_distribution) {
        ProductionCostProduction::factory()->create([
            'production_cost_id' => $production_cost->id,
            'product_id' => $product_distribution['product'],
            'count' => $product_distribution['count']
        ]);
    }

}