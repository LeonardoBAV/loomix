<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiningResource\Pages\CreateLining;
use App\Filament\Resources\LiningResource\Pages\EditLining;
use App\Filament\Resources\LiningResource\Pages\ListLinings;
use App\Models\Lining;
use Filament\Forms\Components\FileUpload;
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

class LiningResource extends Resource
{
    protected static ?string $model = Lining::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): string
    {
        return __('Supplies');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('Linings');
    }


    public static function getModelLabel(): string
    {
        return __('Lining');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Linings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255)->translateLabel('name'),    
                TextInput::make('code')->required()->unique(ignoreRecord: true)->maxLength(255)->translateLabel('code'),
                TextInput::make('price')->required()->numeric()->prefix('$')->minValue(0)->step(0.01)->translateLabel('price'),
                FileUpload::make('image')->image()->imageEditor()->disk('public')->directory('linings')->translateLabel('image'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->translateLabel('name'),
                TextColumn::make('code')->searchable()->sortable()->translateLabel('code'),
                TextColumn::make('price')->money('BRL', locale: 'pt_BR')->sortable()->translateLabel('price'),
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
            'index' => ListLinings::route('/'),
            'create' => CreateLining::route('/create'),
            'edit' => EditLining::route('/{record}/edit'),
        ];
    }
} 