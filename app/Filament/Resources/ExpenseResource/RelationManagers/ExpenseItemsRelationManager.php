<?php

namespace App\Filament\Resources\ExpenseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'expenseItems';

    protected static ?string $recordTitleAttribute = 'description';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Expense Items');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')->required()->maxLength(255)->translateLabel('description'),
                TextInput::make('cost')->required()->numeric()->prefix('$')->minValue(0)->step(0.01)->translateLabel('cost')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                TextColumn::make('description'),
                TextColumn::make('cost')->money('BRL', locale: 'pt_BR'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->modalHeading(__('Create Expense Item'))->label('Create Expense Item')->translateLabel('Create Expense Item')->slideOver()->after(function () {
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
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
