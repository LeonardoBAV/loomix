<?php

namespace App\Models;

use App\Observers\TrimObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([TrimObserver::class])]
class Trim extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'price',
        'unit',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'unit' => 'string',
    ];

    public const UNITS = [
        'meters',
        'unit',
        'kilos',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', 'total'])
            ->withTimestamps()
            ->using(ProductTrim::class);
    }

    public function productTrims(): HasMany
    {
        return $this->hasMany(ProductTrim::class);
    }
}
