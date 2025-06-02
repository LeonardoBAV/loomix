<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lining extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'price',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(LiningProduct::class)
            ->withPivot(['quantity', 'total'])
            ->withTimestamps();
    }
} 