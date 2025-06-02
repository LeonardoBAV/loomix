<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FabricResource\Pages;
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
use Filament\Tables\Filters\TernaryFilter;

class FabricResource extends Resource
{
    protected static ?string $model = Fabric::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?string $navigationLabel = 'Fabrics';

    protected static ?string $navigationGroup = 'Supplies';

    protected static ?string $modelLabel = 'Fabric';

    protected static ?string $pluralModelLabel = 'Fabrics';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Fabric Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter fabric name'),

                                TextInput::make('code')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('Enter fabric code'),
                            ]),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->step(0.0001)
                            ->placeholder('Enter fabric price per unit'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('code')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price')
                    ->money('USD')
                    ->sortable()
                    ->alignRight(),

                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('export')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function (Collection $records) {
                            // Implement export if needed
                        }),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListFabrics::route('/'),
            'create' => Pages\CreateFabric::route('/create'),
            'edit' => Pages\EditFabric::route('/{record}/edit'),
        ];
    }
}
