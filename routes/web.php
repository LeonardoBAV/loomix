<?php

use App\Livewire\Teste;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

Route::get('/', function () {
    /*$html = '<h1 style="color: #6366F1; font-family: sans-serif;">PDF gerado com Browsershot!</h1>';

    Browsershot::html($html)
    ->setChromePath('/usr/bin/google-chrome-stable')
    ->addChromiumArguments([
        'no-sandbox',
        'disable-setuid-sandbox',
        'disable-gpu',
    ])
    ->save(storage_path('app/public/teste.pdf'));

    return 'PDF salvo em storage/app/public/teste.pdf';
*/
    //return view('pdf.product-info');
    return view('welcome');
});

//Route::get('teste', Teste::class  );


