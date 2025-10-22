<?php

namespace App\Observers;

use App\Models\Fabric;
use App\Models\FabricShape;

class FabricObserver
{
    

    public function updated(Fabric $fabric)
    {
        $fabric->fabricShapes()->each(function (FabricShape $fabric_shape) use ($fabric) {
            $fabric_shape->update([
                'cost' => ($fabric->price/1000) * $fabric_shape->usage
            ]); //obs: test and execute this in action and job and center this logic
        });
    }
    
}

