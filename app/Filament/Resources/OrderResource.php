<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Resources\OrderResource\Pages\ViewOrders;
use App\Filament\Resources\OrderResource\RelationManagers\ProductionsRelationManager;
use App\Models\Order;
use App\Services\OrderService;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('resources.orders.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.manufacturing');
    }

    public static function getModelLabel(): string
    {
        return __('resources.orders.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.orders.plural_model_label');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('resources.orders.infolist.title'))
                    ->schema([
                        TextEntry::make('client.name')->label(__('resources.orders.infolist.client'))->weight(FontWeight::Bold),
                        TextEntry::make('note')->label(__('resources.orders.infolist.note')),
                        TextEntry::make('created_at')->translateLabel()->dateTime('d/m/Y H:i'),
                        TextEntry::make('updated_at')->translateLabel()->dateTime('d/m/Y H:i'),
                    ])->columns(2),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // id column
                // TextColumn::make('id')->sortable(),
                //
                Select::make('client_id')->label(__('resources.orders.form.client'))->relationship('client', 'name')->searchable()->required()->columnSpanFull(),
                Textarea::make('note')->label(__('resources.orders.form.note'))->rows(3)->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')->label(__('resources.orders.table.client'))->sortable()->description(fn (Order $record) => "#{$record->id}")->weight(FontWeight::Bold),
                TextColumn::make('units')->label(__('resources.orders.table.units'))->getStateUsing(function (Order $record) {
                    $record->load('productions.productionGrids');

                    return "$record->units ".__('resources.orders.table.units_suffix');
                }),

                TextColumn::make('note')->label(__('resources.orders.table.note')),

                TextColumn::make('created_at')->translateLabel()->dateTime('d/m/Y H:i')->sortable(),
                TextColumn::make('updated_at')->translateLabel()->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make()->visible(fn (Order $record) => app(OrderService::class)->canBeDeleted($record)),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function (Builder $query) {
                return $query->orderBy('created_at', 'desc');
            });
    }

    public static function getRelations(): array
    {
        return [
            ProductionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'view' => ViewOrders::route('/{record}'),
        ];
    }
}
