<?php

namespace App\Jobs;

use App\Actions\RecalculateProductionCostAction;
use App\Models\ProductionCost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RecalculateProductionCostJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public ProductionCost $production_cost)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new RecalculateProductionCostAction())->execute($this->production_cost);
    }
}
