<?php

namespace App\Observers;

use App\Models\Production;
use Filament\Notifications\Notification;

class ProductionObserver
{
    public function creating(Production $production)
    {
        $production->date_started = now();
    }

    public function updated(Production $production)
    {
        if ($production->wasChanged('date_completed') || $production->wasChanged('date_finishing') || $production->wasChanged('date_sewing') || $production->wasChanged('date_cutting')) {
            Notification::make()
                ->title(__('notifications.success'))
                ->body(__('notifications.production.observer.production_updated'))
                ->success()
                ->color('success')
                ->send();
        }
    }
}
