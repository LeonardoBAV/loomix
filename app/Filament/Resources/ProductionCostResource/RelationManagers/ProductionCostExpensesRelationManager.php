<?php

namespace App\Filament\Resources\ProductionCostResource\RelationManagers;

use App\Models\ProductionCostExpense;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\DissociateBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProductionCostExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'productionCostExpenses';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('resources.production_costs.relation_managers.expenses.title');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->maxLength(255)->label(__('resources.production_costs.relation_managers.expenses.form.title'))
                    ->unique(ignoreRecord: true),
                TextInput::make('value')->required()->numeric()->minValue(0)->label(__('resources.production_costs.relation_managers.expenses.form.value'))->prefix('R$')->step(0.02),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle(fn (ProductionCostExpense $record): string => 'casa')
            ->recordTitleAttribute('casa')
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('value')->money('BRL', locale: 'pt_BR'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->label(__('resources.production_costs.relation_managers.expenses.create'))
                    ->modalHeading(__('resources.production_costs.relation_managers.expenses.create'))->after(function () {
                        $this->dispatch('refresh');
                    }),
            ])
            ->actions([
                EditAction::make()->after(function () {
                    $this->dispatch('refresh');
                }),
                DeleteAction::make()->after(function () {
                    $this->dispatch('refresh');
                }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
