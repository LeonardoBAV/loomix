<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'image',
        'is_active',
        'production_weight',
        'product_category_id',
    ];

    public function product_category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function shapes()
    {
        return $this->hasMany(Shape::class);
    }

    public function trims(): BelongsToMany
    {
        return $this->belongsToMany(Trim::class)->withPivot('quantity', 'total')->using(ProductTrim::class);
    }


    public function product_trims(): HasMany
    {
        return $this->hasMany(ProductTrim::class);
    }


    public function fabric_shapes(): HasManyThrough
    {
        return $this->hasManyThrough(FabricShape::class, Shape::class);
    }

    public function productArrangements(): HasMany
    {
        return $this->hasMany(ProductArrangement::class);
    }

    public function productionCostProductions(): HasMany
    {
        return $this->hasMany(ProductionCostProduction::class);
    }

    /*public function productionItems(): HasMany
    {
        return $this->hasMany(ProductionItem::class);
    }*/

    public function getCostAttribute(): float
    {
        return 23423.1923;
    }


    protected function supplyCost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->fabricCost + $this->trimsCost,
        );
    }

    protected function fabricCost(): Attribute
    {
        /*$fabric_shapes = $this->fabric_shapes()->whereHas('productArrangements', function ($query) {
            $query->whereDefault(true);
            $query->whereProductId($this->id);
        })->sum('cost');*/
        $id = $this->id;
        //$this->productArrangements()->whereDefault(true)->sum('cost');
        return Attribute::make(
            get: fn () => $this->fabric_shapes()->whereHas('productArrangements', function ($query) use ($id) {
                $query->whereDefault(true);
                $query->whereProductId($id);
            })->sum('cost'),
        );
    }

    protected function trimsCost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->product_trims()->sum('total'),
        );
    }

    public static function listByCategoryId(int $category_id): Collection
    {
        return self::whereProductCategoryId($category_id)->get();
    }

    public function switchDefaultProductArrangement(ProductArrangement | int $product_arrangement): void
    {
        if(!$product_arrangement instanceof ProductArrangement) {
            $product_arrangement = ProductArrangement::find($product_arrangement);
        }
        
        $this->productArrangements()->whereDefault(true)->update(['default' => false]);
        $product_arrangement->update(['default' => true]);
    }

    public function hasDefaultProductArrangement(): bool
    { 
        return $this->productArrangements()->whereDefault(true)->exists();
    }
     
    /*protected function totalSampleCost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->totalSampleFabricCost + $this->totalSampleTrimsCost + $this->totalSampleLiningsCost,
        );
    }

    protected function totalSampleLiningsCost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->lining_products()->sum('total'),
        );
    }*/

}
