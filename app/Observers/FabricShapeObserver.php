<?php

namespace App\Observers;

use App\Models\FabricShape;
use App\Models\Fabric;

class FabricShapeObserver
{
    /**
     * Handle the FabricShape "creating" event.
     */
    public function creating(FabricShape $fabricShape): void
    {
        // Get the fabric to access its price
        $fabric = Fabric::find($fabricShape->fabric_id);

        if ($fabric) {
            // Calculate cost using rule of three
            // If price is per kg and usage is in kg, then:
            // cost = (price * usage)
            $fabricShape->cost = ($fabric->price/1000) * $fabricShape->usage;
        }
    }

    /**
     * Handle the FabricShape "updating" event.
     */
    public function updating(FabricShape $fabricShape): void
    {
        // If either fabric_id or usage is being changed, recalculate the cost
        /*if ($fabricShape->isDirty(['fabric_id', 'usage'])) {
            $fabric = Fabric::find($fabricShape->fabric_id);

            if ($fabric) {
                $fabricShape->cost = $fabric->price * $fabricShape->usage;
            }
        }*/

        // obs: tem que recalcular se o preco do tecido mudar neh
    }
}
