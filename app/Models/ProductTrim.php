<?php

namespace App\Models;

use App\Observers\ProductTrimObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy([ProductTrimObserver::class])]
class ProductTrim extends Pivot
{
    protected $table = 'product_trim';

    public $incrementing = true;

    protected $fillable = [
        'product_id',
        'trim_id',
        'quantity',
        'unit',
        'total'
    ];

    protected $casts = [
        'quantity' => 'decimal:2'
    ];

    public function trim()
    {
        return $this->belongsTo(Trim::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*protected function unit(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => __($value),
        );
    }*/
    
} 