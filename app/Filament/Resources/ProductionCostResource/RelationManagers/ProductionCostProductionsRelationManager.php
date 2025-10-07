<?php

namespace App\Filament\Resources\ProductionCostResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use App\Helpers\UtilHelper;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductionCostProductionsRelationManager extends RelationManager
{
    protected static string $relationship = 'productionCostProductions';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('resources.production_costs.relation_managers.productions.title');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')->relationship('product', 'name')->label(__('resources.production_costs.relation_managers.productions.form.product'))->required(),
                TextInput::make('count')->label(__('resources.production_costs.relation_managers.productions.form.count'))->required()->integer()->minValue(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                TextColumn::make('product.name')->label(__('resources.production_costs.relation_managers.productions.table.product'))
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('primary')
                    ->url(fn ($record) => ProductResource::getUrl('view', ['record' => $record->product])),
                TextColumn::make('count')->label(__('resources.production_costs.relation_managers.productions.table.count'))
                    ->summarize(Sum::make()),
                TextColumn::make('cost')->label(__('resources.production_costs.relation_managers.productions.table.cost'))->money('BRL', locale: 'pt_BR')->badge()->color('success'),
                TextColumn::make('20%')->label(__('10%'))->badge()->color('success')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($this->calculateSalePrice($record, 20)))->default(0),
                TextColumn::make('20%')->label(__('20%'))->badge()->color('success')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($this->calculateSalePrice($record, 20)))->default(0),
                TextColumn::make('20%')->label(__('30%'))->badge()->color('success')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($this->calculateSalePrice($record, 20)))->default(0),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->label(__('resources.production_costs.relation_managers.productions.create'))
                ->modalHeading(__('resources.production_costs.relation_managers.productions.create')),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    private function calculateSalePrice($record , $percent): float
    {
        return ((($percent*($record->product->supply_cost+$record->cost))/(80-$percent) ) * 100)/ ($percent);
    }
}
