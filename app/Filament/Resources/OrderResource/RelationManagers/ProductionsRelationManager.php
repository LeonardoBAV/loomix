<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Enums\ProductionStatusEnum;
use App\Filament\Resources\ProductionResource;
use App\Filament\Resources\ProductResource;
use App\Models\Production;
use App\Models\ProductionGrid;
use App\Models\Size;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\AssociateAction;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DetachBulkAction;
use Filament\Tables\Actions\DissociateAction;
use Filament\Tables\Actions\DissociateBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ProductionsRelationManager extends RelationManager
{
    protected static string $relationship = 'productions';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')->relationship('product', 'name')->label(__('resources.orders.relation_managers.productions.form.product'))->required(),
                Select::make('cutter_id')->relationship('cutter', 'name')->label(__('resources.orders.relation_managers.productions.form.cutter')),
                Select::make('color_id')->relationship('color', 'title')->label(__('resources.orders.relation_managers.productions.form.color'))->required(),

                DatePicker::make('date_started')->label(__('resources.orders.relation_managers.productions.form.date_started'))->required()->native(false),
               // DatePicker::make('date_cutting')->label(__('resources.orders.relation_managers.productions.form.date_cutting'))->visibleOn('edit')->native(false),
               //DatePicker::make('date_sewing')->label(__('resources.productions.form.date_sewing'))->visibleOn('edit')->native(false),
               //DatePicker::make('date_finishing')->label(__('resources.orders.relation_managers.productions.form.date_finishing'))->visibleOn('edit')->native(false),
               //DatePicker::make('date_completed')->label(__('resources.orders.relation_managers.productions.form.date_completed'))->visibleOn('edit')->native(false),

                Toggle::make('sample')->label(__('resources.orders.relation_managers.productions.form.sample'))->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        $sizes = Size::all();

        $statuses = collect(ProductionStatusEnum::cases())->mapWithKeys(function ($status) {
            return [
                $status->value => __('enums.production_status.' . $status->value)
            ];
        });
        
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                TextColumn::make('product.name')->label(__('resources.orders.relation_managers.productions.table.product'))->description(fn(Production $record) => $record->color->title . ($record->sample ? ' - ' . __('resources.orders.relation_managers.productions.table.sample') : ''))->weight(FontWeight::Bold)->sortable()->searchable()
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('primary')
                    ->url(fn($record) => ProductResource::getUrl('view', ['record' => $record->product])),
                ...$sizes->map(function (Size $size) {
                    return TextColumn::make('size_' . $size->alias)->summarize(Sum::make())->label($size->alias)->default(0);
                }),
                TextColumn::make('total_qty')->label(__('resources.orders.relation_managers.productions.table.total_qty'))->summarize(Sum::make())->default(0),
                TextColumn::make('status')->label(__('resources.orders.relation_managers.productions.table.status'))->badge()->sortable()
                    ->getStateUsing(fn(Production $record) => __('enums.production_status.' . $record->status->value))
                    ->color(fn(Production $record) => $record->status->color())
                    ->summarize(
                        Summarizer::make()
                            ->label(__('resources.orders.relation_managers.productions.table.summary.status'))
                            ->using(function (QueryBuilder $query): string {
                                return (string) $query
                                    ->join('products', 'productions.product_id', '=', 'products.id')
                                    ->selectRaw('SUM(products.production_weight * COALESCE((
                                    SELECT SUM(qty) 
                                    FROM production_grids 
                                    WHERE production_grids.production_id = productions.id
                                ), 0)) as total_weight')
                                    ->value('total_weight') ?? 0;
                            })->numeric(),
                    ),
                TextColumn::make('cutter.name')->label(__('resources.orders.relation_managers.productions.table.cutter'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('order.client.name')->label(__('resources.orders.relation_managers.productions.table.client'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_cutting')->label(__('resources.productions.table.date_cutting'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_sewing')->label(__('resources.orders.relation_managers.productions.table.date_sewing'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_finishing')->label(__('resources.orders.relation_managers.productions.table.date_finishing'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_completed')->label(__('resources.orders.relation_managers.productions.table.date_completed'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label(__('resources.orders.relation_managers.productions.table.created_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label(__('resources.orders.relation_managers.productions.table.updated_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()->label(__('resources.orders.relation_managers.productions.header_actions.create'))->slideOver(),
            ])
            ->actions([
                //ViewAction::make(),
                //link to view production
                Action::make('view_production')->label(__('resources.orders.relation_managers.productions.table.view'))->icon('heroicon-o-eye')->color('gray')->url(fn($record) => ProductionResource::getUrl('view', ['record' => $record->id]))
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) use ($sizes) {

                foreach ($sizes as $size) {
                    $query->addSelect([
                        'size_' . $size->alias => ProductionGrid::select('qty')
                            ->whereColumn('production_id', 'productions.id')
                            ->where('size_id', $size->id)
                            ->limit(1)
                    ]);
                }

                $query->withSum([
                    'productionGrids as total_qty' => function (Builder $q) {}
                ], 'qty');

                return $query->orderBy('created_at', 'desc');
            });;
    }
}
