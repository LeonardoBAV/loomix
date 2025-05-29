<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trim extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'price',
        'unit'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'unit' => 'string'
    ];

    public const UNITS = [
        'meters',
        'unit',
        'kilos'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', 'total'])
            ->withTimestamps();
    }
} 