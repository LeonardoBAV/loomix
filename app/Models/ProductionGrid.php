<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionGrid extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_id',
        'size_id',
        'qty'
    ];

    protected $casts = [
        'qty' => 'integer'
    ];

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
} 