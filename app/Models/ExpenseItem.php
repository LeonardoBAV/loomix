<?php

namespace App\Models;

use App\Observers\ExpenseItemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ExpenseItemObserver::class])]
class ExpenseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id',
        'description',
        'cost'
    ];

    protected $casts = [
        'cost' => 'decimal:4'
    ];

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function allItemsFromExpense(): ExpenseItem
    {
        return ExpenseItem::whereExpenseId($this->expense_id)->get();
    }
} 