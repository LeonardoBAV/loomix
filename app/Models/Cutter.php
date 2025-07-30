<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cutter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function productions(): HasMany
    {
        return $this->hasMany(Production::class);
    }
} 