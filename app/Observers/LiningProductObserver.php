<?php

namespace App\Observers;

use App\Models\LiningProduct;

class LiningProductObserver
{
    public function creating(LiningProduct $lining_product): void
    {
        $lining_product->total = $lining_product->lining->price * $lining_product->quantity;
    }
}
