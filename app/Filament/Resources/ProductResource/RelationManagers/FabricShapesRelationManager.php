<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Fabric;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;

class FabricShapesRelationManager extends RelationManager
{
    protected static string $relationship = 'fabricShapes';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('fabric_id')
                    ->label('Fabric')
                    ->options(Fabric::pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('usage')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->placeholder('Enter fabric usage'),

                FileUpload::make('image')
                    ->image()
                    ->directory('fabric-shapes')
                    ->preserveFilenames()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080'),

                Toggle::make('sample')
                    ->label('Is Sample')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fabric.name')->label('Name')->sortable()->searchable()->translateLabel('Name'),
                TextColumn::make('usage')->label('Usage')->sortable()->searchable()->translateLabel('usage'),
                ImageColumn::make('image')->square()->translateLabel('image'),
                IconColumn::make('sample')->boolean()->sortable()->translateLabel('sample'),
                TextColumn::make('created_at')->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('created_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->modalHeading('Add Fabric to Shape')
                    ->modalWidth('2xl'),
            ])
            ->actions([
                EditAction::make()->modalHeading(__('Edit Fabric Shape'))->modalWidth('2xl'),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
