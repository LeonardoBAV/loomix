<?php

namespace App\Observers;

use App\Models\Fabric;
use App\Models\FabricShape;

class FabricShapeObserver
{
    public function creating(FabricShape $fabricShape): void
    {
        $fabric = Fabric::find($fabricShape->fabric_id);

        if ($fabric) {
            $fabricShape->cost = ($fabric->price / 1000) * $fabricShape->usage;
        }
    }

    public function updating(FabricShape $fabricShape): void {}
}
