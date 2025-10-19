<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FabricShape extends Model
{
    use HasFactory;
    protected $table = 'fabric_shape';//obs:change to pivot table after


    protected $fillable = [
        'fabric_id',
        'shape_id',
        'usage',
        'cost',
        'image',
        'sample',
    ];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }

    public function shape()
    {
        return $this->belongsTo(Shape::class);
    }

    public function productArrangements(): BelongsToMany
    {
        return $this->belongsToMany(ProductArrangement::class, 'fabric_shape_product_arrangement', 'fabric_shape_id', 'product_arrangement_id')->using(FabricShapeProductArrangement::class);
        //return $this->belongsToMany(ProductArrangement::class);
    }
}
