<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionResource\Pages;
use App\Filament\Resources\ProductionResource\Pages\ListProductions;
use App\Filament\Resources\ProductionResource\Pages\ViewProduction;
use App\Filament\Resources\ProductionResource\RelationManagers;
use App\Filament\Resources\ProductionResource\RelationManagers\ProductionItemsRelationManager;
use App\Models\Production;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as SectionInfolists;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class ProductionResource extends Resource
{
    protected static ?string $model = Production::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return __('Manufacturing');
    }

    public static function getNavigationLabel(): string
    {
        return __('Productions');
    }


    public static function getModelLabel(): string
    {
        return __('Production');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Productions');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')->required()->native(false)->displayFormat('m/Y')->translateLabel('date'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                SectionInfolists::make(__('Production Information'))->schema([
                    TextEntry::make('date')->translateLabel('date')->date('m/Y'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')->date()->sortable()->translateLabel('date')->date('m/Y'),
                TextColumn::make('productionItems.product.name')->translateLabel('products')->listWithLineBreaks()->sortable(),
                TextColumn::make('productionItems.count')->label('Count')->translateLabel('count')->listWithLineBreaks()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('created_at'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('updated_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
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
            ProductionItemsRelationManager::class,
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
