<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FabricShapeProductArrangement extends Pivot
{
    protected $table = 'fabric_shape_product_arrangement';

    protected $fillable = [
        'product_arrangement_id',
        'fabric_shape_id',
    ];

    public function productArrangement()
    {
        return $this->belongsTo(ProductArrangement::class);
    }

    public function fabricShape()
    {
        return $this->belongsTo(FabricShape::class);
    }
}
