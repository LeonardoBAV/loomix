<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages\ManageProductCategories;
use App\Models\ProductCategory;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.manufacturing');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources.product_categories.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('resources.product_categories.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.product_categories.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::formSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('resources.product_categories.table.name'))->searchable()->sortable(),
                TextColumn::make('products_count')->label(__('resources.product_categories.table.products'))->counts('products')->badge()->color('info'),
                TextColumn::make('created_at')->translateLabel()->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->translateLabel()->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProductCategories::route('/'),
        ];
    }

    public static function formSchema(): array
    {
        return [
            TextInput::make('name')->label(__('resources.product_categories.form.name'))->required()->maxLength(255)->unique(ignoreRecord: true),
        ];
    }
}
