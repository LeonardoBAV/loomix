<?php

namespace App\Livewire;

use App\Models\FabricShape;
use App\Models\Shape;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class FabricShapeTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Shape $shape;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                FabricShape::whereShapeId($this->shape->id)->with('fabric')
            )
            ->columns([
                TextColumn::make('fabric.name')->label('Name')->translateLabel('Name'),
                TextColumn::make('usage')->label('Usage')->translateLabel('Usage')->formatStateUsing(fn ($state) => $state.' gr'),
                TextColumn::make('cost')->label('Cost')->translateLabel('Cost')->money('BRL', locale: 'pt_BR'),
            ])->actions([
            Action::make('delete')
                ->label('Delete')->translateLabel('Delete')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->action(function (FabricShape $fabric_shape) {
                    $fabric_shape->delete();
                }),
        ]);
    }

    public function render()
    {
        return view('livewire.fabric-shape-table');
    }
}
