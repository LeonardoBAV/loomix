<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'cost'
    ];

    protected $casts = [
        'date' => 'date',
        'cost' => 'decimal:4'
    ];

    public function expenseItems(): HasMany
    {
        return $this->hasMany(ExpenseItem::class);
    }

    public function updateCost(): void
    {
        $expense_items = $this->expenseItems;
        
        $sum_cost = $expense_items->sum(function (ExpenseItem $expense_item) {
            return $expense_item->cost;
        });

        $this->update(['cost' => $sum_cost]);
    }
} 