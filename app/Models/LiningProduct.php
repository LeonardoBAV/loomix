<?php

namespace App\Models;

use App\Observers\LiningProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[ObservedBy([LiningProductObserver::class])]
class LiningProduct extends Pivot
{
    protected $table = 'lining_product';

    public $incrementing = true;

    protected $fillable = [
        'product_id',
        'lining_id',
        'quantity',
        'total'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'total' => 'decimal:2'
    ];


    public function lining()
    {
        return $this->belongsTo(Lining::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
   
} 