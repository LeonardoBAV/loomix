<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    //accessor
    protected function averageWeight(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->products()->avg('production_weight'),
        );
    }

    public static function listAllProductsCategoriesWithProducts($relations = []): Collection
    {
        return ProductCategory::has('products')->with($relations)->get();
    }
}

