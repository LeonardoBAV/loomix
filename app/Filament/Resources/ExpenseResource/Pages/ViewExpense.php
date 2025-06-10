<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\ExpenseItem;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Attributes\On;

class ViewExpense extends ViewRecord
{
    protected static string $resource = ExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('Edit'))->icon('heroicon-o-pencil-square')->color('primary')->button()->slideOver(),
            Action::make('copy')->translateLabel('copy')->icon('heroicon-o-clipboard-document-list')->color('secondary')->form([
                DatePicker::make('date')->required()->native(false)->displayFormat('m/Y')->format('Y-m')->translateLabel('date')
            ])
            ->action(function (array $data, Expense $expense): void {
                $expense_new = Expense::create([
                    'date' => $data['date'],
                    'cost' => 0,
                ]);

                foreach($expense->expenseItems as $expense_item){
                    ExpenseItem::create([
                        'expense_id' => $expense_new->id,
                        'description' => $expense_item->description,
                        'cost' => $expense_item->cost,
                    ]);
                }

                Notification::make()
                    ->title(__('Saved successfully'))
                    ->success()
                    ->color('success')
                    ->body(__('Expense copied'))
                    ->send();

                $this->refresh();
            }),
        ];
    }

    #[On('refresh')]
    public function refresh(): void
    {
    }
   
}
