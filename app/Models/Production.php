<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function productionItems(): HasMany
    {
        return $this->hasMany(ProductionItem::class);
    }

    public function getTotalPontuation(): int
    {
        return $this->productionItems()->with('product')->get()->sum(function ($production_item) {
            return $production_item->count * $production_item->product->production_weight;
        });
    }
} 