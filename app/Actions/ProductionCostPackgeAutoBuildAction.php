<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductionCost;
use App\Models\ProductionCostProduction;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;


class ProductionCostPackgeAutoBuildAction
{


    public function execute(ProductionCost $production_cost, int $qty, Collection $percentages): void
    {
        //remove all production cost productions
        $production_cost->clearPackage();

        $percentages = $percentages->map(fn($percentage) => ['product_category_id' => $percentage['product_category_id'], 'percentage' => $percentage['percentage'], 'qty' => ($percentage['percentage'] * $qty / 100)]);

        foreach($percentages as $percentage) {
            $products = Product::listByCategoryId($percentage['product_category_id']);
            $qty = $percentage['qty'] / $products->count();            

            foreach($products as $product) {
                ProductionCostProduction::create([
                    'production_cost_id' => $production_cost->id,
                    'product_id' => $product->id,
                    'count' => $qty
                ]);
            }
        }

        Notification::make()
            ->title(__('notifications.success'))
            ->body(__('notifications.body.actions.production_cost_packge_auto_build'))
            ->success()
            ->color('success')
            ->send();

    }

}