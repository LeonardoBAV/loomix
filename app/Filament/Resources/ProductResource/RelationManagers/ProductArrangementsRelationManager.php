<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\ProductArrangement;
use App\Models\Shape;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProductArrangementsRelationManager extends RelationManager
{
    protected static string $relationship = 'productArrangements';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('resources.products.relation_managers.product_arrangements.title');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        $shapes = Shape::listByProductId($this->ownerRecord->id, ['fabricShapes']);

        return $form
            ->schema([
                ...$shapes->map(function (Shape $shape) {
                    return Select::make('shape_id_'.$shape->id)->label($shape->name)->options($shape->fabricShapes->pluck('fabric.name', 'id'))->required()->hiddenOn('edit');
                }),
                TextInput::make('sale_price')->label(__('resources.products.relation_managers.product_arrangements.form.sale_price'))->required()->numeric()->minValue(0)->hiddenOn('create'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('default')
            ->columns([
                IconColumn::make('default')->label(__('resources.production_costs.table.default'))->boolean()->alignCenter()
                    ->icon(function (bool $state) {
                        return $state ? 'mdi-toggle-switch-variant' : 'mdi-toggle-switch-variant-off';
                    })->color(fn (bool $state): string => $state ? 'primary' : 'gray')
                    ->action(function (ProductArrangement $productArrangement) {
                        if ($productArrangement->default) {
                            Notification::make()
                                ->title(__('notifications.warning'))
                                ->body(__('notifications.body.resources.products.relation_managers.product_arrangements.table.at_least_one_default_required'))
                                ->warning()
                                ->color('warning')
                                ->send();
                        } else {
                            $this->ownerRecord->switchDefaultProductArrangement($productArrangement);
                            Notification::make()
                                ->title(__('notifications.success'))
                                ->body(__('notifications.body.resources.products.relation_managers.product_arrangements.table.default_updated'))
                                ->success()
                                ->color('success')
                                ->send();
                        }
                    })->alignStart(),
                TextColumn::make('fabricShapes.shape.name')->label(__('resources.products.relation_managers.product_arrangements.table.shapes'))->listWithLineBreaks(),
                TextColumn::make('fabricShapes.fabric.name')->label(__('resources.products.relation_managers.product_arrangements.table.fabric'))->listWithLineBreaks(),

                TextColumn::make('fabricShapes_sum_cost')->label(__('resources.products.relation_managers.product_arrangements.table.cost'))->getStateUsing(function (ProductArrangement $product_arrangement) {
                    return $product_arrangement->fabricShapes()->sum('cost');
                })->money('BRL', locale: 'pt_BR')->badge()->color('info')->alignCenter(),
                TextColumn::make('sale_price')->label(__('resources.products.relation_managers.product_arrangements.table.sale_price'))->money('BRL', locale: 'pt_BR')->badge()->color('success')->default('N/A')->alignCenter(),

                TextColumn::make('updated_at')->dateTime('d/m/Y H:i')->sortable()->translateLabel('updated_at')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('d/m/Y H:i')->sortable()->translateLabel('created_at')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                DeleteAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->modalHeading(__('resources.products.relation_managers.product_arrangements.table.create'))
                    ->label(__('resources.products.relation_managers.product_arrangements.table.create'))
                    ->translateLabel('Create Shape')
                    ->slideOver()
                    ->action(function (array $data) {

                        $arrangements = $this->ownerRecord->productArrangements()->with('fabricShapes')->get()->map(function ($product_arrangement) {
                            return $product_arrangement->fabricShapes->pluck('id')->sort()->values()->toArray();
                        });
                        $fabric_shape_ids = collect($data)->sort()->values()->map(fn ($value) => (int) $value)->toArray();

                        $result = $arrangements->contains(function ($arrangement) use ($fabric_shape_ids) {
                            return collect($arrangement)->diff($fabric_shape_ids)->isEmpty() && collect($fabric_shape_ids)->diff($arrangement)->isEmpty();
                        });

                        if ($result) {
                            Notification::make()
                                ->title(__('notifications.warning'))
                                ->body(__('notifications.body.resources.products.relation_managers.product_arrangements.table.arrangement_already_exists'))
                                ->warning()
                                ->color('warning')
                                ->send();

                            return;
                        }

                        $product_arrangement = ProductArrangement::create([
                            'product_id' => $this->ownerRecord->id,
                        ]);

                        $product_arrangement->fabricShapes()->attach($data);
                        Notification::make()
                            ->title(__('notifications.success'))
                            ->body(__('notifications.body.resources.products.relation_managers.product_arrangements.table.created'))
                            ->success()
                            ->color('success')
                            ->send();
                    }),
            ])->striped();
    }
}
