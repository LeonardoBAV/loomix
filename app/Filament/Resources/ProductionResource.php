<?php

namespace App\Filament\Resources;

use App\Enums\ProductionStatusEnum;
use App\Filament\Resources\ProductionResource\Pages;
use App\Filament\Resources\ProductionResource\Pages\ListProductions;
use App\Filament\Resources\ProductionResource\Pages\ViewProduction;
use App\Filament\Resources\ProductionResource\RelationManagers;
use App\Filament\Resources\ProductionResource\RelationManagers\ProductionGridsRelationManager;
use App\Models\Production;
use App\Models\Size;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ProductionResource extends Resource
{
    protected static ?string $model = Production::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?int $navigationSort = 1;



    public static function getNavigationLabel(): string
    {
        return __('resources.productions.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.fabrication');
    }

    public static function getModelLabel(): string
    {
        return __('resources.productions.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.productions.plural_model_label');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('Production Information'))->schema([
                    TextEntry::make('product.name')->label(__('resources.productions.table.product')),
                    TextEntry::make('cutter.name')->label(__('resources.productions.table.cutter')),
                    TextEntry::make('client.name')->label(__('resources.productions.table.client')),
                    TextEntry::make('color.title')->label(__('resources.productions.table.color')),
                    TextEntry::make('date_started')->label(__('resources.productions.table.date_started')),
                    TextEntry::make('date_cutting')->label(__('resources.productions.table.date_cutting')),
                    TextEntry::make('date_sewing')->label(__('resources.productions.table.date_sewing')),
                    TextEntry::make('date_finishing')->label(__('resources.productions.table.date_finishing')),
                    TextEntry::make('date_completed')->label(__('resources.productions.table.date_completed')),
                    TextEntry::make('created_at')->label(__('resources.productions.table.created_at')),
                    TextEntry::make('updated_at')->label(__('resources.productions.table.updated_at')),
                ])->columns(3),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')->relationship('product', 'name')->label(__('resources.productions.form.product'))->required(),
                Select::make('cutter_id')->relationship('cutter', 'name')->label(__('resources.productions.form.cutter'))->required(),
                Select::make('client_id')->relationship('client', 'name')->label(__('resources.productions.form.client'))->required(),
                Select::make('color_id')->relationship('color', 'title')->label(__('resources.productions.form.color'))->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $sizes = Size::all();
        return $table
            ->columns([
                TextColumn::make('product.name')->label(__('resources.productions.table.product'))->sortable(),
                TextColumn::make('color.title')->label(__('resources.productions.table.color'))->sortable(),
                ...$sizes->map(function (Size $size) {
                    return TextColumn::make('size_'.$size->alias)->formatStateUsing(fn (Production $record) => $record->qty($size))->label($size->alias)->default(0);
                }),
                TextColumn::make('status')->label(__('resources.productions.table.status'))->badge()->sortable()
                    ->getStateUsing(fn (Production $record) => __('enums.production_status.'.$record->status->value))
                    ->color(fn (Production $record) => $record->status->color()),
                TextColumn::make('date_started')->label(__('resources.productions.table.date_started'))->date('d/m/Y')->sortable(),
                TextColumn::make('cutter.name')->label(__('resources.productions.table.cutter'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('client.name')->label(__('resources.productions.table.client'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_cutting')->label(__('resources.productions.table.date_cutting'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_sewing')->label(__('resources.productions.table.date_sewing'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_finishing')->label(__('resources.productions.table.date_finishing'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_completed')->label(__('resources.productions.table.date_completed'))->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label(__('resources.productions.table.created_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label(__('resources.productions.table.updated_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
                ActionGroup::make([
                    //next and previus action
                    Action::make('next')->label(__('resources.productions.table.next'))->icon('fas-arrow-right')->color('primary')
                        ->action(fn (Production $record) => $record->nextStep())
                        ->visible(fn (Production $record) => $record->status !== ProductionStatusEnum::Completed),
                    Action::make('previus')->label(__('resources.productions.table.previus'))->icon('fas-arrow-left')->color('primary')
                        ->action(fn (Production $record) => $record->previusStep())
                        ->visible(fn (Production $record) => $record->status !== ProductionStatusEnum::Pending),
                ]),
                //group button with start production, stop production, complete production
            ])
            ->bulkActions([
                
            ]);
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->orderBy('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            ProductionGridsRelationManager::class,
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
