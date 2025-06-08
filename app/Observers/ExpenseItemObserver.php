<?php

namespace App\Observers;

use App\Models\ExpenseItem;

class ExpenseItemObserver
{
    
    public function created(ExpenseItem $expense_item)
    {
        $expense_item->expense->updateCost(); 
    }

    public function updated(ExpenseItem $expense_item)
    {
        $expense_item->expense->updateCost(); 
    }

    public function deleted(ExpenseItem $expense_item)
    {
        $expense_item->expense->updateCost();
    }


}
