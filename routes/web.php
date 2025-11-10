<?php

use App\Livewire\Teste;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

Route::get('/', function () {
    $html = '<h1 style="color: #6366F1; font-family: sans-serif;">PDF gerado com Browsershot!</h1>';

    // Pdf::view('pdfs.invoice', ['invoice' => $invoice])

    /* Pdf::html('<h1>PDF testando args!</h1>')
     ->format('a4')
     ->save(storage_path('app/public/teste.pdf'));
*/
    /*Pdf::html(function (\Spatie\Browsershot\Browsershot $browser) {
        $browser->setChromePath('/home/sail/.cache/puppeteer/chrome/linux-137.0.7151.55/chrome-linux64/chrome');
        $browser->addChromiumArguments([
            'no-sandbox',
            'disable-gpu',
            'disable-setuid-sandbox',
        ]);
    })->html($html)
      ->format('a4')
      ->save(storage_path('app/public/teste.pdf'));
*/

    // Browsershot::html($html)
    // ->setChromePath('/usr/bin/google-chrome-stable')
    // ->addChromiumArguments([
    //    'no-sandbox',
    //    'disable-setuid-sandbox',
    //    'disable-gpu',
    // ])
    // ->save(storage_path('app/public/teste.pdf'));

    // return 'PDF salvo em storage/app/public/teste.pdf';

    // return view('pdf.product-info');
    return view('welcome');
});

// Route::get('teste', Teste::class  );

/*
use Spatie\LaravelPdf\Facades\Pdf;

Pdf::view('pdfs.invoice', ['invoice' => $invoice])
    ->format('a4')
    ->save('invoice.pdf')


*/
