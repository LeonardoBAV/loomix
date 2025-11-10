<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrimResource\Pages\CreateTrim;
use App\Filament\Resources\TrimResource\Pages\EditTrim;
use App\Filament\Resources\TrimResource\Pages\ListTrims;
use App\Models\Trim;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TrimResource extends Resource
{
    protected static ?string $model = Trim::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): string
    {
        return __('Supplies');
    }

    public static function getNavigationLabel(): string
    {
        return __('Trims');
    }

    public static function getModelLabel(): string
    {
        return __('Trim');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Trims');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255)->translateLabel('name'),
                TextInput::make('code')->required()->unique(ignoreRecord: true)->maxLength(255)->translateLabel('code'),
                TextInput::make('price')->required()->numeric()->prefix('$')->minValue(0)->step(0.01)->translateLabel('price'),
                FileUpload::make('image')->image()->imageEditor()->disk('public')->directory('trims')->translateLabel('image'),
                Select::make('unit')->required()->options([
                    'meters' => __('Meters'),
                    'unit' => __('Unit'),
                    'kilos' => __('Kilos'),
                ])->translateLabel('unit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->translateLabel('name'),
                TextColumn::make('code')->searchable()->sortable()->translateLabel('code'),
                TextColumn::make('price')->money('BRL', locale: 'pt_BR')->sortable()->translateLabel('price'),
                TextColumn::make('unit')->sortable()->translateLabel('unit'),
                ImageColumn::make('image')->disk('public')->translateLabel('image'),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('created_at'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('updated_at'),
            ])
            ->filters([
                SelectFilter::make('unit')
                    ->options([
                        'meters' => 'Meters',
                        'unit' => 'Unit',
                        'kilos' => 'Kilos',
                    ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrims::route('/'),
            'create' => CreateTrim::route('/create'),
            'edit' => EditTrim::route('/{record}/edit'),
        ];
    }
}
