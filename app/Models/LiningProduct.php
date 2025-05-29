<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LiningProduct extends Pivot
{
    protected $table = 'lining_product';

    public $incrementing = true;

    protected $fillable = [
        'product_id',
        'lining_id',
        'quantity',
        'unit',
        'total'
    ];

    protected $casts = [
        'quantity' => 'decimal:2'
    ];
} 