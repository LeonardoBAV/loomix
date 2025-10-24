<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ProductResource;
use App\Helpers\UtilHelper;
use App\Models\ProductArrangement;
use App\Models\ProductionCost;
use App\Models\ProductionCostProduction;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class PriceListPage extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.price-list-page';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function getTitle(): string
    {
        return __('pages.price_list.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('pages.price_list.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('pages.menu.navigation_group');
    }

    public function mount(): void
    {
        $this->form->fill([
            'production_cost_id' => ProductionCost::loadDefault()->id,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('production_cost_id')
                    ->label(__('pages.price_list.form.production_cost'))
                    ->options(ProductionCost::all()->pluck('title', 'id'))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live(),

            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table->query(ProductArrangement::query())->columns([
            TextColumn::make('fabricShapes.shape.name')->label(__('pages.price_list.table.shapes'))->listWithLineBreaks(),
            TextColumn::make('fabricShapes.fabric.name')->label(__('pages.price_list.table.fabric'))->listWithLineBreaks(),
            TextColumn::make('materialCost')->label(__('pages.price_list.table.supply_cost'))->money('BRL', locale: 'pt_BR')->badge()->color('info')->alignCenter()
                ->getStateUsing(fn ($record) => $record->product->materialCost($record)),
            
            TextColumn::make('productionCost')->label(__('pages.price_list.table.production_cost'))->money('BRL', locale: 'pt_BR')->badge()->color('info')
                ->getStateUsing(fn ($record) => $record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0)->alignCenter(),

            TextColumn::make('productionTotalCost')->label(__('pages.price_list.table.production_total_cost'))->money('BRL', locale: 'pt_BR')->badge()->color('info')
                ->getStateUsing(fn ($record) => (($record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0) + $record->product->materialCost($record)))->alignCenter(),

            TextColumn::make('30%')->money('BRL', locale: 'pt_BR')->badge()->color('primary')
                ->getStateUsing(fn ($record) => $this->salesPrice((($record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0) + $record->product->materialCost($record)), 30))
                ->alignCenter()
                //font smaller of the description
                ->description(fn ($record) => new HtmlString('<span class="text-xs text-gray-500">' . UtilHelper::formatMoney($this->salesPrice((($record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0) + $record->product->materialCost($record)), 30) * 0.3 ) . '</span>')),

            TextColumn::make('35%')->money('BRL', locale: 'pt_BR')->badge()->color('primary')
                ->getStateUsing(fn ($record) => $this->salesPrice((($record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0) + $record->product->materialCost($record)), 35))
                ->alignCenter()
                ->description(fn ($record) => new HtmlString('<span class="text-xs text-gray-500">' . UtilHelper::formatMoney($this->salesPrice((($record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0) + $record->product->materialCost($record)), 35) * 0.35 ) . '</span>')),

            TextColumn::make('40%')->money('BRL', locale: 'pt_BR')->badge()->color('primary')
                ->getStateUsing(fn ($record) => $this->salesPrice((($record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0) + $record->product->materialCost($record)), 40))
                ->alignCenter()
                ->description(fn ($record) => new HtmlString('<span class="text-xs text-gray-500">' . UtilHelper::formatMoney($this->salesPrice((($record->product->productionCostProductions->where('production_cost_id', $this->data['production_cost_id'])->first()->cost ?? 0) + $record->product->materialCost($record)), 40) * 0.4 ) . '</span>')),

            TextColumn::make('sale_price')->label(__('pages.price_list.table.sale_price'))->money('BRL', locale: 'pt_BR')->badge()->color('success')->default('N/A')->alignCenter(),


        ])
        ->groups([
            Group::make('product.id')
                ->label(__('pages.price_list.table.product'))
                ->getTitleFromRecordUsing(fn (ProductArrangement $record): string => $record->product->name)
                ->getDescriptionFromRecordUsing(fn (ProductArrangement $record): string => __("pages.price_list.table.arrangements_count", ['count' => $record->product->productArrangements()->count()]))
                ->collapsible()
        ])
            ->filters([
                SelectFilter::make('product_category_id')
                    ->label(__('pages.price_list.table.filter.category'))
                    ->relationship('product.product_category', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),
                SelectFilter::make('product_id')
                    ->label(__('pages.price_list.table.filter.product'))
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
        ->defaultGroup('product.id')
        ->paginated(false);
        /*return $table
            ->query(ProductionCostProduction::whereProductionCostId($this->data['production_cost_id']))
            ->columns([
                TextColumn::make('product.name')->label(__('pages.price_list.table.product'))
                    ->weight(FontWeight::Bold)->description(fn ($record) => $record->product->product_category->name)
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('primary')
                    ->url(fn ($record) => ProductResource::getUrl('view', ['record' => $record->product])),
                
                TextColumn::make('cost_material')->label(__('pages.price_list.table.material'))
                    ->money('BRL', locale: 'pt_BR')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($record) => UtilHelper::formatMoney($record->product->supply_cost))->default(0),
                TextColumn::make('cost')->label(__('pages.price_list.table.operational'))->money('BRL', locale: 'pt_BR')->badge()->color('success'),
            ])->paginated(false);*/
    }

    public function updatedDataProductionCostId(): void
    {
        $this->resetTable();
    }

    private function salesPrice(float $cost, int $percentage): float
    {
        return ($cost/((0.9)-($percentage/100)));
    }


}
