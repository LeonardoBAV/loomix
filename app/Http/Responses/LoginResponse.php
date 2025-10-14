<?php

namespace App\Http\Responses;
 
use App\Filament\Resources\OrderResource;
use App\Filament\StageControl\Resources\ProductionResource;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Filament\Http\Responses\Auth\LoginResponse as FilamentLoginResponse;
 
class LoginResponse extends FilamentLoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        if (Filament::getCurrentPanel()->getId() === 'stage-control') {
            return redirect()->to(ProductionResource::getUrl('index'));
        }

        //return redirect()->to(Filament::getUrl('dashboard'));
        return redirect()->intended(Filament::getUrl());
    }
}