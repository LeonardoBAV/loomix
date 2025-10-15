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

    public function clearPackage(): void
    {
        $this->productionCostProductions()->delete();
    }

    
    
    
    
    
    /**
     * Retorna a distribuição de categorias de produtos com percentuais
     * para uso no gráfico de pizza
     */
    /*public function getCategoryDistribution(): array
    {
        $productions = $this->productionCostProductions()
            ->with('product.product_category')
            ->get();
        
        $total = $productions->sum('count');
        
        if ($total === 0) {
            return [];
        }
        
        $distribution = $productions
            ->groupBy(fn($item) => $item->product->product_category?->name ?? 'Sem Categoria')
            ->map(function ($items) use ($total) {
                $category_total = $items->sum('count');
                return [
                    'count' => $category_total,
                    'percentage' => round(($category_total / $total) * 100, 2),
                ];
            })
            ->sortByDesc('count');
        
        return $distribution->toArray();
    }*/

    public function getTotalWeight(): float
    {
        return $this->productionCostProductions()->with('product')->get()
            ->sum(function ($production) {
                $weight = $production->product->production_weight ?? 0;
                return $weight * $production->count;
            });
    }

    public function getTotalPieces(): int
    {
        return $this->productionCostProductions()->sum('count');
    }
} 