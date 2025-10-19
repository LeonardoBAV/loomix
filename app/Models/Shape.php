<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function fabrics(): BelongsToMany
    {
        return $this->belongsToMany(Fabric::class);
    }

    public static function listByProductId($product_id, $relations = [])
    {
        return self::whereProductId($product_id)->with($relations)->get();
    }
}
