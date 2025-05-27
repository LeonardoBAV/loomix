<?php

namespace App\Livewire;

use App\Models\FabricShape;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FabricShapeTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
        ->query(
            FabricShape::limit(10)->with('fabric')
        )
        ->columns([ 
            TextColumn::make('fabric.name'),
            TextColumn::make('usage'),
            TextColumn::make('cost'),
            ImageColumn::make('image')
        ]);
    }
    

    public function render()
    {
        return view('livewire.fabric-shape-table');
    }
}
