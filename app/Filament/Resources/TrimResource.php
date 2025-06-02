<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrimResource\Pages;
use App\Models\Trim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TrimResource extends Resource
{
    protected static ?string $model = Trim::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    protected static ?string $navigationGroup = 'Supplies';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('trims'),

                Forms\Components\Select::make('unit')
                    ->required()
                    ->options([
                        'meters' => 'Meters',
                        'unit' => 'Unit',
                        'kilos' => 'Kilos',
                    ])
                    ->default('unit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('unit')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit')
                    ->options([
                        'meters' => 'Meters',
                        'unit' => 'Unit',
                        'kilos' => 'Kilos',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTrims::route('/'),
            'create' => Pages\CreateTrim::route('/create'),
            'edit' => Pages\EditTrim::route('/{record}/edit'),
        ];
    }
} 