<?php

namespace App\Models;

use App\Observers\ProductArrangementObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ObservedBy([ProductArrangementObserver::class])]
class ProductArrangement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'default',
        'sale_price',
    ];

    protected $casts = [
        'default' => 'boolean',
    ];

    public function fabricShapes(): BelongsToMany
    {
        return $this->belongsToMany(FabricShape::class, 'fabric_shape_product_arrangement', 'product_arrangement_id', 'fabric_shape_id')
            ->using(FabricShapeProductArrangement::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
