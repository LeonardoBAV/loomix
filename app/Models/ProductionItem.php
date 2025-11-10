<?php

namespace App\Models;

// use App\Observers\ProductionItemObserver;
// use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// #[ObservedBy([ProductionItemObserver::class])]
class ProductionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_id',
        'product_id',
        'count',
    ];

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function getLatestProductionItemInProductionFromProduct(Product $product): ?ProductionItem
    {
        return self::where('product_id', $product->id)->whereHas('production', function ($query) {
            $query->latest('date');
        })->with('production')->first();
    }
}
