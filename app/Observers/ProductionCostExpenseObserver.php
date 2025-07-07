<?php

namespace App\Observers;

use App\Jobs\RecalculateProductionCostJob;
use App\Models\ProductionCostExpense;

class ProductionCostExpenseObserver
{

    public function created(ProductionCostExpense $production_cost_expense)
    {
        RecalculateProductionCostJob::dispatch($production_cost_expense->productionCost)->onConnection('sync');
    }

    public function updated(ProductionCostExpense $production_cost_expense)
    {
        RecalculateProductionCostJob::dispatch($production_cost_expense->productionCost)->onConnection('sync');
    }

    public function deleted(ProductionCostExpense $production_cost_expense)
    {
        RecalculateProductionCostJob::dispatch($production_cost_expense->productionCost);
    }
}
