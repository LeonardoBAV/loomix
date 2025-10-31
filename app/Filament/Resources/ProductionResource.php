<?php

namespace App\Filament\Resources;

use App\Enums\ProductionStatusEnum;
use App\Filament\Exports\ProductionExporter;
use App\Filament\Resources\ProductionResource\Pages;
use App\Filament\Resources\ProductionResource\Pages\ListProductions;
use App\Filament\Resources\ProductionResource\Pages\ViewProduction;
use App\Filament\Resources\ProductionResource\RelationManagers;
use App\Filament\Resources\ProductionResource\RelationManagers\ProductionGridsRelationManager;
use App\Models\Client;
use App\Models\Production;
use App\Models\ProductionGrid;
use App\Models\Size;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ProductionResource extends Resource
{
    protected static ?string $model = Production::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?int $navigationSort = 3;


    public static function getNavigationLabel(): string
    {
        return __('resources.productions.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.fabrication');
    }

    public static function getModelLabel(): string
    {
        return __('resources.productions.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.productions.plural_model_label');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('Production Information'))->schema([
                    TextEntry::make('product.name')->label(__('resources.productions.table.product')),
                    TextEntry::make('cutter.name')->label(__('resources.productions.table.cutter')),
                    TextEntry::make('client.name')->label(__('resources.productions.table.client')),
                    TextEntry::make('color.title')->label(__('resources.productions.table.color')),
                    TextEntry::make('date_started')->label(__('resources.productions.table.date_started')),
                    TextEntry::make('date_cutting')->label(__('resources.productions.table.date_cutting')),
                    TextEntry::make('date_sewing')->label(__('resources.productions.table.date_sewing')),
                    TextEntry::make('date_finishing')->label(__('resources.productions.table.date_finishing')),
                    TextEntry::make('date_completed')->label(__('resources.productions.table.date_completed')),
                    TextEntry::make('sample')
                        ->label(__('resources.productions.form.sample'))
                        ->badge()
                        ->formatStateUsing(fn($state): string => $state ? __('resources.productions.infolist.sample.yes') : __('resources.productions.infolist.sample.no'))
                        ->color(fn($state): string => $state ? 'primary' : 'gray'),
                    TextEntry::make('created_at')->label(__('resources.productions.table.created_at')),
                    TextEntry::make('updated_at')->label(__('resources.productions.table.updated_at')),
                ])->columns(3),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')->relationship('product', 'name')->label(__('resources.productions.form.product'))->required(),
                Select::make('cutter_id')->relationship('cutter', 'name')->label(__('resources.productions.form.cutter')),
                Select::make('client_id')->relationship('client', 'name')->label(__('resources.productions.form.client'))->required(),
                Select::make('color_id')->relationship('color', 'title')->label(__('resources.productions.form.color'))->required(),
                // put date_started in the form
                DatePicker::make('date_started')->label(__('resources.productions.form.date_started'))->required()->columnSpanFull(),
                DatePicker::make('date_cutting')->label(__('resources.productions.form.date_cutting'))->visibleOn('edit'),
                DatePicker::make('date_sewing')->label(__('resources.productions.form.date_sewing'))->visibleOn('edit'),
                DatePicker::make('date_finishing')->label(__('resources.productions.form.date_finishing'))->visibleOn('edit'),
                DatePicker::make('date_completed')->label(__('resources.productions.form.date_completed'))->visibleOn('edit'),
                Toggle::make('sample')->label(__('resources.productions.form.sample'))->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        $sizes = Size::all();

        $statuses = collect(ProductionStatusEnum::cases())->mapWithKeys(function ($status) {
            return [
                $status->value => __('enums.production_status.' . $status->value)
            ];
        });

        return $table
            ->columns([
                TextColumn::make('product.name')->label(__('resources.productions.table.product'))->description(fn(Production $record) => $record->color->title . ($record->sample ? ' - ' . __('resources.productions.table.sample') : ''))->weight(FontWeight::Bold)->sortable()->searchable()
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('primary')
                    ->url(fn($record) => ProductResource::getUrl('view', ['record' => $record->product])),
                ...$sizes->map(function (Size $size) {
                    return TextColumn::make('size_' . $size->alias)->summarize(Sum::make())->label($size->alias)->default(0);
                }),
                TextColumn::make('total_qty')->label(__('resources.productions.table.total_qty'))->summarize(Sum::make())->default(0),
                TextColumn::make('status')->label(__('resources.productions.table.status'))->badge()->sortable()
                    ->getStateUsing(fn(Production $record) => __('enums.production_status.' . $record->status->value))
                    ->color(fn(Production $record) => $record->status->color())
                    ->summarize(
                        Summarizer::make()
                            ->label(__('resources.productions.table.summary.status'))
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


                /*
                 ->summarize(Summarizer::make()
        ->label('First last name')
        ->using(fn (Builder $query): string => $query->min('last_name'))) */
                //TextColumn::make('date_started')->label(__('resources.productions.table.date_started'))->date('d/m/Y')->sortable(),
                TextColumn::make('cutter.name')->label(__('resources.productions.table.cutter'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('client.name')->label(__('resources.productions.table.client'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_cutting')->label(__('resources.productions.table.date_cutting'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_sewing')->label(__('resources.productions.table.date_sewing'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_finishing')->label(__('resources.productions.table.date_finishing'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_completed')->label(__('resources.productions.table.date_completed'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label(__('resources.productions.table.created_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label(__('resources.productions.table.updated_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //filter by date finishing year and month only
                Filter::make('date_finishing')
                    ->form([
                        DatePicker::make('date_finishing')->label(__('resources.productions.table.filter.date_finishing'))->displayFormat('m/Y')->native(false)->closeOnDateSelection(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if ($data['date_finishing']) {
                            $date_finishing = Carbon::parse($data['date_finishing']);
                            $query->whereYear('date_finishing', $date_finishing->year)->whereMonth('date_finishing', $date_finishing->month);
                        }
                        return $query;
                    })->indicateUsing(function (array $data): string {
                        if ($data['date_finishing']) {
                            $date_finishing = Carbon::parse($data['date_finishing']);
                            return __('resources.productions.table.filter.date_finishing') . ': ' . $date_finishing->format('m/Y');
                        }
                        return '';
                    }),

                Filter::make('status')
                    ->form([
                        Select::make('status')->options($statuses)->label(__('resources.productions.table.filter.status'))->multiple()->default(['pending', 'cutting', 'sewing', 'finishing']),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        $query->where(function (Builder $query) use ($data) {
                            if (in_array(ProductionStatusEnum::Completed->value, $data['status'])) {
                                //dd($data);
                                $query->orWhere(function (Builder $query) {
                                    $query->whereNotNull('date_completed');
                                });
                            }

                            if (in_array(ProductionStatusEnum::Finishing->value, $data['status'])) {
                                $query->orWhere(function (Builder $query) {
                                    $query->whereNotNull('date_finishing');
                                    $query->whereNull('date_completed');
                                });
                            }

                            if (in_array(ProductionStatusEnum::Sewing->value, $data['status'])) {
                                $query->orWhere(function (Builder $query) {
                                    $query->whereNotNull('date_sewing');
                                    $query->whereNull('date_finishing');
                                });
                            }

                            if (in_array(ProductionStatusEnum::Cutting->value, $data['status'])) {
                                $query->orWhere(function (Builder $query) {
                                    $query->whereNotNull('date_cutting');
                                    $query->whereNull('date_sewing');
                                });
                            }

                            if (in_array(ProductionStatusEnum::Pending->value, $data['status'])) {
                                $query->orWhere(function (Builder $query) {
                                    $query->whereNull('date_cutting');
                                });
                            }
                        });

                        return $query;
                    })->indicateUsing(function (array $data) use ($statuses): string {
                        if (! $data['status']) {
                            return '';
                        }

                        $values = collect($data['status'])->map(function ($status) use ($statuses) {
                            return $statuses[$status];
                        });

                        return __('resources.productions.table.filter.status') . ': ' . implode(', ',  $values->toArray());
                    }),
                Filter::make('sample')->label(__('resources.productions.table.filter.sample'))->query(function (Builder $query, array $data): Builder {
                    return $query->whereSample(true);
                }),
                SelectFilter::make('client_id')
                    ->relationship('client', 'name')->label(__('resources.productions.table.filter.client')),
                SelectFilter::make('color_id')
                    ->relationship('color', 'title')->label(__('resources.productions.table.filter.color')),
            ])
            ->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label(__('resources.productions.table.filter.button')),
            )
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    DeleteAction::make(),
                    //next and previus action
                    Action::make('next')->label(__('resources.productions.table.next'))->icon('fas-arrow-right')->color('primary')
                        ->action(fn(Production $record) => $record->nextStep())
                        ->visible(fn(Production $record) => $record->status !== ProductionStatusEnum::Completed),
                    Action::make('previus')->label(__('resources.productions.table.previus'))->icon('fas-arrow-left')->color('primary')
                        ->action(fn(Production $record) => $record->previusStep())
                        ->visible(fn(Production $record) => $record->status !== ProductionStatusEnum::Pending),
                ]),
                //group button with start production, stop production, complete production
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ProductionExporter::class)->columnMapping(false)
            ])
            ->bulkActions([])
            ->modifyQueryUsing(function (Builder $query) use ($sizes) {

                // Adicionar subquery para cada tamanho
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

                /*$query->addSelect([
                    'total_qty' => ProductionGrid::select('qty')
                        ->whereColumn('production_id', 'productions.id')
                        ->where('size_id', 1)
                        ->sum('qty')
                ]);*/


                return $query->orderBy('created_at', 'desc');
            });
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->orderBy('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            ProductionGridsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductions::route('/'),
            'view' => ViewProduction::route('/{record}'),
        ];
    }
}
