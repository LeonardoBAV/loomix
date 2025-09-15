<?php

namespace App\Observers;

use App\Models\Production;

class ProductionObserver
{
    public function creating(Production $production)
    {
        $production->date_started = now();
    }


}
