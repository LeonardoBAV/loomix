<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages\ListExpenses;
use App\Filament\Resources\ExpenseResource\Pages\ViewExpense;
use App\Filament\Resources\ExpenseResource\RelationManagers\ExpenseItemsRelationManager;
use App\Models\Expense;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Infolists\Components\Section as SectionInfolists;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\DeleteAction;
use Livewire\Attributes\On;

class ExpenseResource extends Resource
{

    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): string
    {
        return __('Finances');
    }

    public static function getNavigationLabel(): string
    {
        return __('Expenses');
    }


    public static function getModelLabel(): string
    {
        return __('Expense');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Expenses');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')->required()->native(false)->displayFormat('m/Y')->format('Y-m')->translateLabel('date')
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                SectionInfolists::make(__('Expense Information'))->schema([
                    TextEntry::make('date')->translateLabel('date')->date('m/Y'),
                    TextEntry::make('cost')->translateLabel('cost')->money('BRL', locale: 'pt_BR'),
                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')->date('m/Y')->sortable()->translateLabel('date'),
                TextColumn::make('cost')->money('BRL', locale: 'pt_BR')->sortable()->translateLabel('cost'),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ExpenseItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExpenses::route('/'),
            'view' => ViewExpense::route('/{record}'),
            //'create' => Pages\CreateExpense::route('/create'),
            //'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
