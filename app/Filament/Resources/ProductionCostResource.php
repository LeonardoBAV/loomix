<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionCostResource\Pages;
use App\Filament\Resources\ProductionCostResource\Pages\EditProductionCost;
use App\Filament\Resources\ProductionCostResource\Pages\ListProductionCosts;
use App\Filament\Resources\ProductionCostResource\Pages\ViewProductionCosts;
use App\Filament\Resources\ProductionCostResource\RelationManagers;
use App\Filament\Resources\ProductionCostResource\RelationManagers\ExpensesRelationManager;
use App\Filament\Resources\ProductionCostResource\RelationManagers\ProductionCostExpensesRelationManager;
use App\Filament\Resources\ProductionCostResource\RelationManagers\ProductionCostProductionsRelationManager;
use App\Models\ProductionCost;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as SectionInfolists;
use Filament\Infolists\Infolist;

class ProductionCostResource extends Resource
{
    protected static ?string $model = ProductionCost::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('resources.production_costs.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.manufacturing');
    }

    public static function getModelLabel(): string
    {
        return __('resources.production_costs.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.production_costs.plural_model_label');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                SectionInfolists::make(__('resources.production_costs.infolist.section.title'))->schema([
                    TextEntry::make('title')->label(__('resources.production_costs.infolist.title')),
                    TextEntry::make('default')->label(__('resources.production_costs.infolist.default'))->badge()
                     ->color(fn (bool $state): string => $state ? 'primary' : 'gray')
                     ->formatStateUsing(fn (bool $state): string => $state ? __('resources.production_costs.infolist.default_true') : __('resources.production_costs.infolist.default_false')),
                    TextEntry::make('expense')->label(__('resources.production_costs.infolist.expense'))->money('BRL', locale: 'pt_BR')->badge()->color('success'),
                    TextEntry::make('created_at')->dateTime('d/m/Y H:i')->translateLabel(),
                ])->columns(2),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('title')->label(__('resources.production_costs.form.title'))->required()->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('resources.production_costs.table.title'))->searchable(),
                IconColumn::make('default')->label(__('resources.production_costs.table.default'))->boolean()->alignCenter()
                 ->icon(function (bool $state) {
                    return $state ? 'mdi-toggle-switch-variant' : 'mdi-toggle-switch-variant-off';
                })->color(fn (bool $state): string => $state ? 'primary' : 'gray')
                ->action(function (ProductionCost $productionCost) {
                    ProductionCost::newDefault($productionCost);
                    Notification::make()
                            ->title(__('notification.success'))
                            ->body(__('resources.production_costs.table.default_updated'))
                            ->success()
                            ->color('success')
                            ->send();
                }),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
            ProductionCostProductionsRelationManager::class,
            ProductionCostExpensesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductionCosts::route('/'),
            'view' => ViewProductionCosts::route('/{record}'),
        ];
    }
}
