<?php

namespace App\Models;

use App\Observers\ProductionCostProductionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ProductionCostProductionObserver::class])]
class ProductionCostProduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_cost_id',
        'product_id',
        'count',
        'cost'
    ];

    protected $casts = [
        'count' => 'integer',
        'cost' => 'decimal:4'
    ];

    public function productionCost(): BelongsTo
    {
        return $this->belongsTo(ProductionCost::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
} 