<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'cutter_id',
        'client_id',
        'date_started',
        'date_cutting',
        'date_sewing',
        'date_finishing',
        'date_completed'
    ];

    protected $casts = [
        'date_started' => 'date',
        'date_cutting' => 'date',
        'date_sewing' => 'date',
        'date_finishing' => 'date',
        'date_completed' => 'date'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function cutter(): BelongsTo
    {
        return $this->belongsTo(Cutter::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function productionGrids(): HasMany
    {
        return $this->hasMany(ProductionGrid::class);
    }
} 