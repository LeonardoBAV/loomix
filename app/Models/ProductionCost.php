<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'default'
    ];

    protected $casts = [
        'default' => 'boolean'
    ];

    public function productionCostExpenses(): HasMany
    {
        return $this->hasMany(ProductionCostExpense::class);
    }

    public function productionCostProductions(): HasMany
    {
        return $this->hasMany(ProductionCostProduction::class);
    }

    public static function newDefault(ProductionCost $production_cost): void
    {
        ProductionCost::whereDefault(true)->update(['default' => false]);
        $production_cost->update(['default' => true]);
    }

    protected function expense(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->productionCostExpenses->sum('value'),
        );
    }
} 