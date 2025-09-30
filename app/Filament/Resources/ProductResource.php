<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Pages\ViewProduct;
use App\Filament\Resources\ProductResource\RelationManagers\LiningsRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\ShapesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\TrimsRelationManager;
use App\Models\Product;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as SectionInfolists;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Collection;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('Products');
    }

    public static function getNavigationGroup(): string
    {
        return __('Manufacturing');
    }

    public static function getModelLabel(): string
    {
        return __('Product');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Products');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Product Information'))
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255)->placeholder(__('Enter product name'))->translateLabel('name')->columnSpanFull(),
                        TextInput::make('code')->required()->maxLength(255)->unique(ignoreRecord: true)->placeholder(__('Enter product code'))->translateLabel('code'),
                        TextInput::make('production_weight')->required()->numeric()->minValue(1)->translateLabel('production_weight'),
                        FileUpload::make('image')->image()->imageEditor()->disk('public')->directory('products')->columnSpanFull()->translateLabel('image'),
                        Toggle::make('is_active')->label('Status')->default(true)->visibleOn('edit')->translateLabel('Status'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                SectionInfolists::make(__('Product Information'))->schema([
                    ImageEntry::make('image')->disk('public')->circular()->translateLabel('image'),
                    Group::make()->columnSpan(2)->columns(2)->schema([  
                        TextEntry::make('name')->translateLabel('name'),
                        TextEntry::make('code')->translateLabel('code'),
                        TextEntry::make('is_active')->label('Status')->badge()
                            ->getStateUsing(fn (Product $record): string => $record->is_active ? __('Active') : __('Inactive'))
                            ->color(fn (Product $record): string => $record->is_active ? 'primary' : 'gray'),
                        //TextEntry::make('totalSampleCost')->label('Total cost')->money('BRL', locale: 'pt_BR')->translateLabel('Total cost'),
                        TextEntry::make('production_weight')->translateLabel('production_weight')->icon('heroicon-o-scale'),
                        TextEntry::make('created_at')->dateTime('d/m/Y H:i')->translateLabel('created_at'),
                    ]),

                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable()->description(fn (Product $product): string => $product->code)->translateLabel('name'),
                ImageColumn::make('image')->disk('public')->circular()->translateLabel('image'),
                //TextColumn::make('totalSampleCost')->label('Total cost')->sortable()->searchable()->money('BRL', locale: 'pt_BR')->translateLabel('Total cost'),
                TextColumn::make('is_active')->label('Status')->translateLabel('Status')->badge()
                    ->getStateUsing(fn (Product $record): string => $record->is_active ? __('Active') : __('Inactive'))
                    ->color(fn (Product $record): string => $record->is_active ? 'primary' : 'gray'),
                TextColumn::make('production_weight')->label('Production weight')->sortable()->searchable()->icon('heroicon-m-scale')->translateLabel('Production weight')->badge()->color('info'),
                TextColumn::make('created_at')->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('created_at'),
                TextColumn::make('updated_at')->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('updated_at'),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
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
                SelectFilter::make('is_active')
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
                    ])

            ])
            ->actions([
                //Action::make('cost')->translateLabel('cost')->icon('heroicon-o-currency-dollar')->color('secondary')->slideOver(),
                ViewAction::make(),
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
            ShapesRelationManager::class,
            TrimsRelationManager::class,
            //LiningsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            //'create' => CreateProduct::route('/create'),
            //'edit' => EditProduct::route('/{record}/edit'),
            'view' => ViewProduct::route('/{record}'),
        ];
    }
}
