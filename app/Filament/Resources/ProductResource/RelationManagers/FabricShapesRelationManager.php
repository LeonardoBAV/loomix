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
                TextColumn::make('fabric.name')
                    ->label('Fabric')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('usage')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('image')
                    ->square(),

                IconColumn::make('sample')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalHeading('Add Fabric to Shape')
                    ->modalWidth('2xl'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Edit Fabric Shape')
                    ->modalWidth('2xl'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
