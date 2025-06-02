<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FabricShape extends Pivot
{
    use HasFactory;


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
}
