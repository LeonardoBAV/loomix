<?php

namespace App\Actions;

use App\Models\ProductionCost;

class CategoryDistributionOfPCAction
{
    public function execute(ProductionCost $production_cost): array
    {
        $productions = $production_cost->productionCostProductions()->with('product.product_category')->get();

        $total = $productions->sum('count');

        if ($total === 0) {
            return [];
        }

        $distribution = $productions
            ->groupBy(fn ($item) => $item->product->product_category?->name ?? 'Sem Categoria')
            ->map(function ($items) use ($total) {
                $category_total = $items->sum('count');

                return [
                    'count' => $category_total,
                    'percentage' => round(($category_total / $total) * 100, 2),
                ];
            })
            ->sortByDesc('count');

        return $distribution->toArray();
    }
}
