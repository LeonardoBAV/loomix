<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FabricResource\Pages;
use App\Filament\Resources\FabricResource\Pages\CreateFabric;
use App\Filament\Resources\FabricResource\Pages\EditFabric;
use App\Filament\Resources\FabricResource\Pages\ListFabrics;
use App\Filament\Resources\FabricResource\RelationManagers;
use App\Models\Fabric;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\TernaryFilter;

class FabricResource extends Resource
{
    protected static ?string $model = Fabric::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return __('Supplies');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('Fabrics');
    }


    public static function getModelLabel(): string
    {
        return __('Fabric');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Fabrics');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Fabric Information'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')->required()->maxLength(255)->translateLabel('name'),
                                TextInput::make('code')->required()->maxLength(255)->unique(ignoreRecord: true)->translateLabel('code'),
                            ]),

                        TextInput::make('price')->required()->numeric()->prefix('$')->minValue(0)->step(0.0001)->placeholder(__('Price per kilo'))->translateLabel('price'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->translateLabel('name'),
                TextColumn::make('code')->searchable()->sortable()->translateLabel('code'),
                TextColumn::make('price')->money('BRL', locale: 'pt_BR')->sortable()->translateLabel('price'),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('created_at'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('updated_at'),
            ])
            ->filters([
                SelectFilter::make('shapes')
                    ->relationship('fabricShapes.shape', 'name')
                    ->multiple()
                    ->preload(),

                Filter::make('price')
                    ->form([
                        Forms\Components\TextInput::make('price_from')
                            ->numeric()
                            ->placeholder('From'),
                        Forms\Components\TextInput::make('price_until')
                            ->numeric()
                            ->placeholder('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_from'],
                                fn(Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_until'],
                                fn(Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    }),

                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('export')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function (Collection $records) {
                            // Implement export if needed
                        }),
                ]),
            ])
            ->emptyStateActions([
                CreateAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFabrics::route('/'),
            'create' => CreateFabric::route('/create'),
            'edit' => EditFabric::route('/{record}/edit'),
        ];
    }
}
