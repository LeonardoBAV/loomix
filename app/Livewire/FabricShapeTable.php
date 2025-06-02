<?php

namespace App\Livewire;

use App\Models\FabricShape;
use App\Models\Shape;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class FabricShapeTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public Shape $shape;

    public function table(Table $table): Table
    {
        return $table
        ->query(
            FabricShape::whereShapeId($this->shape->id)->with('fabric')
        )
        ->columns([ 
            TextColumn::make('fabric.name'),
            TextColumn::make('usage'),
            TextColumn::make('cost'),
            ToggleColumn::make('sample'),
            ImageColumn::make('image')->disk('public')
        ])->actions([
            Action::make('delete')
                ->label('Delete')
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
