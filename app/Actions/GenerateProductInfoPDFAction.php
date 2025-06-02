<?php

namespace App\Actions;

use App\Models\Product;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class GenerateProductInfoPDFAction
{

    const DIRECTORY = 'products/pdf';

    public function execute(Product $product): void
    {
        $this->checkDirectory();

        Browsershot::html($this->getHtml($product))
            ->setChromePath('/usr/bin/google-chrome-stable')
            ->addChromiumArguments([
                'no-sandbox',
                'disable-setuid-sandbox',
                'disable-gpu',
            ])
            ->save(storage_path($this->getFullPath($product)));
    }

    private function checkDirectory(): void
    {
        if(!Storage::disk('public')->exists(self::DIRECTORY)) {
            Storage::disk('public')->makeDirectory(self::DIRECTORY);
        }
    }

    private function getFullPath(Product $product): string
    {
        return 'app/public/' . self::DIRECTORY . '/' . $product->code . '.pdf';
    }

    private function getHtml(Product $product): string
    {
        return view('pdf.product-info', ['product' => $product])->render();
    }


                //->format('A4')
            //->margins(16, 16, 16, 16)
            //->showBackground()
} 