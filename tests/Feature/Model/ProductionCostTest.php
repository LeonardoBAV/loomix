<?php

use App\Models\Product;
use App\Models\ProductionCost;
use App\Models\ProductionCostProduction;



describe('getTotalWeight', function () {
    

    it('calculates correctly', function (array $production_weights, array $counts, float $expected) {
        // Arrange
        $productionCost = ProductionCost::factory()->create();

        foreach ($production_weights as $index => $production_weight) {
            $product = Product::factory()->create(['production_weight' => $production_weight]);
            ProductionCostProduction::factory()->create([
                'production_cost_id' => $productionCost->id,
                'product_id' => $product->id,
                'count' => $counts[$index]
            ]);
        }
        
        // Act
        $totalWeight = $productionCost->getTotalWeight();
        
        // Assert
        expect($totalWeight)->toBe($expected); 
    })->with('scenarios');

    dataset('scenarios', [
        'empty' => [
            'production_weights' => [],
            'counts' => [],
            'expected' => 0.0,
        ],
        /*'zero production weight' => [ //obs: test in any production weight never be 0
            'production_weights' => [0],
            'counts' => [10],
            'expected' => 0.0,
        ],*/
        'single product' => [
            'production_weights' => [2.5],
            'counts' => [10],
            'expected' => 25.0,
        ],
        'multiple products' => [
            'production_weights' => [2.5, 1.5, 0.5],
            'counts' => [10, 5, 20],
            'expected' => 42.5,
        ],
    ]);

   /* it('calculates total weight with single product', function () {
        // Arrange
        $productionCost = ProductionCost::factory()->create();
        $product = Product::factory()->create(['production_weight' => 2.5]);
        
        ProductionCostProduction::factory()->create([
            'production_cost_id' => $productionCost->id,
            'product_id' => $product->id,
            'count' => 10
        ]);
        
        // Act
        $totalWeight = $productionCost->getTotalWeight();
        
        // Assert
        expect($totalWeight)->toBe(25.0); // 2.5 * 10
    });
    
    it('handles product with null production_weight', function () {
        // Arrange
        $productionCost = ProductionCost::factory()->create();
        $product = Product::factory()->create(['production_weight' => null]);
        
        ProductionCostProduction::factory()->create([
            'production_cost_id' => $productionCost->id,
            'product_id' => $product->id,
            'count' => 5
        ]);
        
        // Act
        $totalWeight = $productionCost->getTotalWeight();
        
        // Assert
        expect($totalWeight)->toBe(0.0); // 0 * 5
    });
    
    it('calculates total weight with multiple products', function () {
        // Arrange
        $productionCost = ProductionCost::factory()->create();
        
        $product1 = Product::factory()->create(['production_weight' => 2.0]);
        $product2 = Product::factory()->create(['production_weight' => 1.5]);
        $product3 = Product::factory()->create(['production_weight' => 0.5]);
        
        ProductionCostProduction::factory()->create([
            'production_cost_id' => $productionCost->id,
            'product_id' => $product1->id,
            'count' => 10
        ]);
        
        ProductionCostProduction::factory()->create([
            'production_cost_id' => $productionCost->id,
            'product_id' => $product2->id,
            'count' => 5
        ]);
        
        ProductionCostProduction::factory()->create([
            'production_cost_id' => $productionCost->id,
            'product_id' => $product3->id,
            'count' => 20
        ]);
        
        // Act
        $totalWeight = $productionCost->getTotalWeight();
        
        // Assert
        expect($totalWeight)->toBe(37.5); // (2.0*10) + (1.5*5) + (0.5*20)
    });
    
    it('returns zero when no productions exist', function () {
        // Arrange
        $productionCost = ProductionCost::factory()->create();
        
        // Act
        $totalWeight = $productionCost->getTotalWeight();
        
        // Assert
        expect($totalWeight)->toBe(0.0);
    });
    
    it('handles decimal quantities correctly', function () {
        // Arrange
        $productionCost = ProductionCost::factory()->create();
        $product = Product::factory()->create(['production_weight' => 1.5]);
        
        ProductionCostProduction::factory()->create([
            'production_cost_id' => $productionCost->id,
            'product_id' => $product->id,
            'count' => 3.5
        ]);
        
        // Act
        $totalWeight = $productionCost->getTotalWeight();
        
        // Assert
        expect($totalWeight)->toBe(5.25); // 1.5 * 3.5
    });*/
});


/*

1. Casos Básicos:
✅ Produto com peso definido - production_weight = 2.5
✅ Produto com peso zero - production_weight = 0
✅ Produto com peso nulo - production_weight = null (deve retornar 0)

2. Múltiplos Produtos:
✅ Vários produtos com pesos diferentes - Mix de pesos
✅ Produtos com mesmo peso - Verificar soma correta
✅ Produtos com quantidades diferentes - count = 10, 5, 3

3. Casos Extremos:
✅ Lista vazia - Sem productionCostProductions
✅ Valores decimais - Peso 2.5, quantidade 3.5
✅ Valores muito grandes - Peso 999.99, quantidade 1000
4. Casos de Negócio:
✅ Produto sem categoria - production_weight = null
✅ Produto inativo - Se houver lógica de status
✅ Peso negativo - Se for possível no sistema

5. Performance/Integração:
✅ Eager loading - Verificar se não faz N+1 queries
✅ Relacionamentos - Se product está sendo carregado corretamente
Os mais importantes: Casos básicos, múltiplos produtos, valores nulos e lista vazia. Esses cobrem 80% dos cenários reais!

*/