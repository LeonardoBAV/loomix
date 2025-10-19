<x-filament-panels::page>
    <div>
        <form wire:submit="create">
            {{ $this->form }}            
        </form>
        
        <x-filament-actions::modals />
    </div>

    <div>
        {{ $this->table }}
    </div>
</x-filament-panels::page>


