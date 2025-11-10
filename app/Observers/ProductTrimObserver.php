<?php

namespace App\Observers;

use App\Models\ProductTrim;

class ProductTrimObserver
{
    public function creating(ProductTrim $product_trim)
    {
        // dd($product_trim);
        $product_trim->total = $product_trim->quantity * $product_trim->trim->price;
        $product_trim->unit = $product_trim->trim->unit;
    }
}
