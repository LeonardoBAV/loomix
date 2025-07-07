<?php

namespace App\Observers;

use App\Jobs\RecalculateProductionCostJob;
use App\Models\ProductionCostProduction;

class ProductionCostProductionObserver
{
    public function creating(ProductionCostProduction $production_cost_production)
    {
        $production_cost_production->cost = 0;//(new CalculateProductionCostOfProductAction())->execute($production_cost_production);
    }

    public function created(ProductionCostProduction $production_cost_production)
    {
        RecalculateProductionCostJob::dispatch($production_cost_production->productionCost)->onConnection('sync');
    }

    public function updated(ProductionCostProduction $production_cost_production)
    {
        RecalculateProductionCostJob::dispatch($production_cost_production->productionCost)->onConnection('sync');
    }

    public function deleted(ProductionCostProduction $production_cost_production)
    {
        RecalculateProductionCostJob::dispatch($production_cost_production->productionCost)->onConnection('sync');
    }
}
