<?php

namespace App\Filament\StageControl\Resources;

use App\Enums\ProductionStatusEnum;
use App\Filament\StageControl\Resources\ProductionResource\Pages;
use App\Filament\StageControl\Resources\ProductionResource\Pages\ManageProductions;
use App\Models\Production;
use App\Models\ProductionGrid;
use App\Models\Size;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductionResource extends Resource
{
    protected static ?string $model = Production::class;

    public static function getModelLabel(): string
    {
        return __('resources.productions.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.productions.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        $sizes = Size::all();
        
        $statuses = collect(ProductionStatusEnum::cases())->mapWithKeys(function ($status) {
            return [
                $status->value => __('enums.production_status.'.$status->value)
            ];
        });

        return $table
            ->columns([
                TextColumn::make('product.name')->label(__('resources.productions.table.product'))->description(fn (Production $record) => $record->color->title)->weight(FontWeight::Bold)->sortable(),
                ...$sizes->map(function (Size $size) {
                    return TextColumn::make('size_'.$size->alias)->label($size->alias)->default(0);
                }),
                //TextColumn::make('total_qty')->label(__('resources.productions.table.total_qty'))->default(0),
                TextColumn::make('status')->label(__('resources.productions.table.status'))->badge()
                    ->getStateUsing(fn (Production $record) => __('enums.production_status.'.$record->status->value))
                    ->color(fn (Production $record) => $record->status->color()),
                //TextColumn::make('client.name')->label(__('resources.productions.table.client'))->sortable(),
                //TextColumn::make('cutter.name')->label(__('resources.productions.table.cutter'))->sortable(),
                //TextColumn::make('date_started')->label(__('resources.productions.table.date_started'))->date('d/m/Y')->sortable(),

            ])
            ->filters([
            ])
            ->actions([
                Action::make('previus')->label(__('resources.productions.table.previus'))->icon('fas-arrow-left')->color('primary')->button()
                ->action(fn (Production $record) => $record->previusStep())
                ->visible(fn (Production $record) => $record->status !== ProductionStatusEnum::Pending),
                Action::make('next')->label(__('resources.productions.table.next'))->icon('fas-arrow-right')->color('info')->button()
                    ->action(fn (Production $record) => $record->nextStep())
                    ->visible(fn (Production $record) => $record->status !== ProductionStatusEnum::Completed),
            ])
            ->bulkActions([
            ])
            ->modifyQueryUsing(function (Builder $query) use ($sizes) {                
                foreach($sizes as $size) {
                    $query->addSelect([
                        'size_'.$size->alias => ProductionGrid::select('qty')
                            ->whereColumn('production_id', 'productions.id')
                            ->where('size_id', $size->id)
                            ->limit(1)
                    ]);
                }

                $query->withSum([
                    'productionGrids as total_qty' => function (Builder $q) {
                    }
                ], 'qty');

                $query->whereNotNull('date_cutting');
                $query->whereNull('date_completed');
                                      
                return $query->orderBy('created_at', 'desc');
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProductions::route('/'),
        ];
    }
}
