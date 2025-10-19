<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Models\Fabric;
use App\Models\Shape;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class ShapesRelationManager extends RelationManager
{
    protected static string $relationship = 'shapes';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Shapes');
    }


    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255)->placeholder(__('Enter shape name'))->translateLabel('name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->sortable()->searchable()->translateLabel('name'),
                TextColumn::make('fabrics.name')->listWithLineBreaks()->translateLabel('fabrics'),
                TextColumn::make('fabricShapes.usage')->label('Usage')->translateLabel('Usage')->listWithLineBreaks()->suffix('gr'),
                TextColumn::make('fabricShapes.cost')->label('Cost')->translateLabel('Cost')->money('BRL', locale: 'pt_BR')->listWithLineBreaks(),
                /*ImageColumn::make('sample_image')
                    ->getStateUsing(function (Shape $shape) {
                        $fabric_shape = $shape->fabricShapes()
                            ->whereSample(true)
                            ->first();
                            
                        return $fabric_shape?->image ?? null;
                    })
                    ->defaultImageUrl('https://placehold.co/400x400/png?text=No+Image')
                    ->circular()->label('Image')->translateLabel('Image'),*/
                TextColumn::make('created_at')->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true)->translateLabel('created_at'),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make()->modalHeading(__('Create Shape'))->label('Create Shape')->translateLabel('Create Shape')->slideOver(),
            ])
            ->actions([
                EditAction::make()->modalHeading(__('Edit Shape'))->slideOver(),
                Action::make('Manage Fabrics')->icon('heroicon-o-squares-2x2')
                ->label('Manage Fabrics')->translateLabel('Manage Fabrics')
                ->modal()
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
                ->modalHeading(fn(Shape $shape) => __('Manage Fabrics for').' '.$shape->name)
                ->modalContent(fn (Action $action, Shape $shape): View => view(
                    'filament.modals.fabric-shape-table',
                    ['action' => $action, 'shape' => $shape],
                ))->registerModalActions([
                    Action::make('Add')->label('Add')->translateLabel('Add')
                    ->icon('heroicon-o-plus')
                    ->form([
                        Select::make('fabric_id')->label('Fabric')->translateLabel('Fabric')->options(Fabric::pluck('name', 'id'))->required()->searchable()->preload(),
                        TextInput::make('usage')->required()->numeric()->minValue(1)->placeholder(__('Enter fabric usage'))->translateLabel('usage')->suffix('gr'),
                        FileUpload::make('image')->image()->directory('fabric-shapes')->preserveFilenames()->imageResizeMode('cover')->imageCropAspectRatio('16:9')->imageResizeTargetWidth('1920')->imageResizeTargetHeight('1080')->translateLabel('image'),
                        Toggle::make('sample')->label('sample')->translateLabel('sample')->default(false),
                    ])
                    ->action(function (array $data, $record) {
                        $record->fabricShapes()->create([
                            'fabric_id' => $data['fabric_id'],
                            'usage' => $data['usage'],
                            'image' => $data['image'],
                            'sample' => $data['sample'],
                        ]);
                    }),
                ]),
                
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
