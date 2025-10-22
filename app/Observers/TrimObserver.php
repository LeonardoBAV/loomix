<?php

namespace App\Observers;

use App\Models\ProductTrim;
use App\Models\Trim;

class TrimObserver
{
    
    public function updated(Trim $trim)
    {
        if($trim->isDirty('price')) {
            $trim->productTrims()->each(function (ProductTrim $product_trim) use ($trim) {
                $product_trim->update([
                        'total' => $product_trim->quantity * $trim->price
                    ]);
                }); //obs: test and execute this in action and job and center this logic
        }

        if($trim->isDirty('unit')) {
            $trim->productTrims()->each(function (ProductTrim $product_trim) use ($trim) {
                $product_trim->update([
                    'unit' => $trim->unit
                ]); //obs: test and execute this in action and job and center this logic
            });
        }
    }
}