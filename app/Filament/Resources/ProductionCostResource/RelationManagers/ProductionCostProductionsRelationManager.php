<?php

namespace App\Filament\Resources\ProductionCostResource\RelationManagers;

use App\Actions\ProductionCostPackgeAutoBuildAction;
use App\Filament\Resources\ProductionCostResource\Widgets\CategoryDistributionChart;
use App\Filament\Resources\ProductionCostResource\Widgets\ProductionCostStatsWidget;
use App\Filament\Resources\ProductResource;
use App\Helpers\UtilHelper;
use App\Models\ProductCategory;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
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
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Livewire\Livewire;

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
        $product_categories = ProductCategory::listAllProductsCategoriesWithProducts(['products']);
        $product_category_id_last = $product_categories->last()->id;

        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                TextColumn::make('product.name')->label(__('resources.production_costs.relation_managers.productions.table.product'))
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('primary')
                    ->url(fn ($record) => ProductResource::getUrl('view', ['record' => $record->product])),
                TextColumn::make('count')->label(__('resources.production_costs.relation_managers.productions.table.count')),
                TextColumn::make('cost_material')->label(__('resources.production_costs.relation_managers.productions.table.material'))->money('BRL', locale: 'pt_BR')->badge()->color('success')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($record->product->supply_cost))->default(0),
                TextColumn::make('cost')->label(__('resources.production_costs.relation_managers.productions.table.cost'))->money('BRL', locale: 'pt_BR')->badge()->color('success'),
                TextColumn::make('total')->label(__('resources.production_costs.relation_managers.productions.table.total'))->money('BRL', locale: 'pt_BR')->badge()->color('success')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($record->product->supply_cost+$record->cost))->default(0),

                //TextColumn::make('10%')->label(__('10%'))->badge()->color('info')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($this->calculateSalePrice($record, 10)))->default(0),
                //TextColumn::make('20%')->label(__('20%'))->badge()->color('info')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($this->calculateSalePrice($record, 20)))->default(0),
                //TextColumn::make('30%')->label(__('30%'))->badge()->color('info')->formatStateUsing(fn ($record) => UtilHelper::formatMoney($this->calculateSalePrice($record, 30)))->default(0),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->label(__('resources.production_costs.relation_managers.productions.create'))
                ->modalHeading(__('resources.production_costs.relation_managers.productions.create')),
                Action::make('quick_building')->label(__('resources.production_costs.relation_managers.productions.quick_building'))
                ->icon('heroicon-o-bolt')
                ->color('info')
                ->form([
                    //make this form with 3 columns
                    Grid::make(4)->schema([
                        TextInput::make('qty')->label(__('resources.production_costs.relation_managers.productions.qty'))->required()->numeric()->minValue(100)->required()->columnSpanFull()->placeholder(10000),
                        ...$product_categories->map(function ($product_category) use ($product_category_id_last, $product_categories) {
                            $text_input = TextInput::make("product_category_id_{$product_category->id}")
                                ->label($product_category->name)
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(100)
                                ->default((int)(100/$product_categories->count()))
                                ->required()
                                ->suffixIcon('heroicon-o-percent-badge')
                                ->hint((int) $product_category->average_weight)
                                ->hintIcon('heroicon-o-scale'); //weight
                            
                            if ($product_category->id === $product_category_id_last) {
                                $text_input->rules([
                                    fn ($get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                        $all_values = collect($get())->except('qty');

                                        if($all_values->sum() !== 100) {
                                            $fail(__('validation.form.sum', ['value' => $all_values->sum(), 'expected' => 100]));
                                        }
                                    },
                                ]);
                            }

                            return $text_input;
                        }),
                    ]),
                ])
                ->action(function ($data) {
                    $percentages = collect($data)->except('qty')->map(function ($value, $key) {
                        return ['product_category_id' => Str::after($key, 'product_category_id_'), 'percentage' => $value];
                    });
 
                    (new ProductionCostPackgeAutoBuildAction())->execute($this->ownerRecord, $data['qty'], $percentages);

                }),
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
