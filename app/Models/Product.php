<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'image',
        'is_active',
    ];

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

    public function lining_products(): HasMany
    {
        return $this->hasMany(LiningProduct::class);
    }

    public function linings(): BelongsToMany
    {
        return $this->belongsToMany(Lining::class)->withPivot('quantity', 'total')->using(LiningProduct::class);
    }

    public function fabric_shapes(): HasManyThrough
    {
        return $this->hasManyThrough(FabricShape::class, Shape::class);
    }

    public function getCostAttribute(): float
    {
        return 23423.1923;
    }

}
