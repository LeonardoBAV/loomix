<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shape extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function fabricShapes()
    {
        return $this->hasMany(FabricShape::class);
    }
}
