<?php

namespace App\Models;

use App\Enums\ProductionStatusEnum;
use App\Observers\ProductionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy([ProductionObserver::class])]
class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'cutter_id',
        'client_id',
        'color_id',
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

    public function qty(Size $size): int
    {
        return $this->productionGrids()->whereSizeId($size->id)->first()->qty ?? 0;
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getStatus(),
        );
    }

    private function getStatus(): ProductionStatusEnum
    {
        if($this->date_completed) {
            return ProductionStatusEnum::Completed;
        }
        if($this->date_finishing) {
            return ProductionStatusEnum::Finishing;
        }
        if($this->date_sewing) {
            return ProductionStatusEnum::Sewing;
        }
        if($this->date_cutting) {
            return ProductionStatusEnum::Cutting;
        }
        return ProductionStatusEnum::Pending;
    }

    public function nextStep()
    {
        switch($this->status) {
            case ProductionStatusEnum::Pending:
                $this->date_cutting = now();
                break;
            case ProductionStatusEnum::Cutting:
                $this->date_sewing = now();
                break;
            case ProductionStatusEnum::Sewing:
                $this->date_finishing = now();
                break;
            case ProductionStatusEnum::Finishing:
                $this->date_completed = now();
                break;
        }

        $this->save();
    }

    public function previusStep()
    {
        switch($this->status) {
            case ProductionStatusEnum::Completed:
                $this->date_completed = null;
                break;
            case ProductionStatusEnum::Finishing:
                $this->date_finishing = null;
                break;
            case ProductionStatusEnum::Sewing:
                $this->date_sewing = null;
                break;
            case ProductionStatusEnum::Cutting:
                $this->date_cutting = null;
                break;
        }
        $this->save();
    }
    
} 