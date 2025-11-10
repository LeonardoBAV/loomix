<?php

namespace App\Models;

use App\Observers\FabricObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([FabricObserver::class])]
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
