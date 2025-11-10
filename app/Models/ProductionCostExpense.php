<?php

namespace App\Models;

use App\Observers\ProductionCostExpenseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ProductionCostExpenseObserver::class])]
class ProductionCostExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_cost_id',
        'title',
        'value',
    ];

    protected $casts = [
        'value' => 'decimal:4',
    ];

    public function productionCost(): BelongsTo
    {
        return $this->belongsTo(ProductionCost::class);
    }
}
