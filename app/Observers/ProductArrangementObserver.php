<?php

namespace App\Observers;

use App\Models\ProductArrangement;
use Filament\Notifications\Notification;

class ProductArrangementObserver
{
    
    public function creating(ProductArrangement $product_arrangement): void
    {
       if(!$product_arrangement->product->hasDefaultProductArrangement()) {
            $product_arrangement->default = true;
       }
    }
}
