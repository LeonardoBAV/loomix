<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class Teste extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function deleteAction(): Action
    {
        return Action::make('delete')
            //->requiresConfirmation()
            ->action(fn () => dd('teste'));
    }

    public function signUpAction(): Action
    {
        return Action::make('signUp')
            ->slideOver()
            ->form([
                Placeholder::make('total_price')
                    ->hiddenLabel()
                    ->content(function (Get $get) {
                        return '$' . count($get('attendees')) * 500;
                    }),
                Repeater::make('attendees')
                    ->schema([]),
            ])
            ->action(function (array $data) {
                collect($data['attendees'])->each(function ($data) {
                    
                });
            })
            ->after(function () {
                Notification::make()->success()->title('Success!')
                    ->body(new HtmlString('You have successfully signed up for the conference.'))->send();
            });
    }

    public function render()
    {
        return view('livewire.teste');
    }
}
