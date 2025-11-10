<?php

namespace App\Actions;

use App\Models\ProductionCost;
use Illuminate\Support\Facades\Log;

class RecalculateProductionCostAction
{
    public function execute(ProductionCost $production_cost): void
    {
        $production_cost->load('productionCostProductions', 'productionCostProductions.product');

        foreach ($production_cost->productionCostProductions as $production_cost_production) {
            $cost = (new CalculateProductionCostOfProductAction)->execute($production_cost_production);
            Log::info('cost: '.$cost, ['id' => $production_cost_production->id]);
            $production_cost_production->updateQuietly(['cost' => $cost]);
        }

    }
}
