<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fabric extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'price',
    ];

    public function fabricShapes()
    {
        return $this->hasMany(FabricShape::class);
    }
}
