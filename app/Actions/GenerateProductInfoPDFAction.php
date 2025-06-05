<?php

namespace App\Actions;

use App\Models\Product;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class GenerateProductInfoPDFAction
{

    const DIRECTORY = 'products/info';

    public function execute(Product $product): string
    {
        $this->checkDirectory();
        $file_name = $product->code . '.pdf';

        Browsershot::html($this->getHtml($product))
            ->setChromePath('/usr/bin/google-chrome-stable')
            ->addChromiumArguments(['no-sandbox', 'disable-setuid-sandbox', 'disable-gpu'])
            ->save(storage_path($this->getFullPath($file_name)));

        return self::DIRECTORY . '/' . $file_name;
    }

    private function checkDirectory(): void
    {
        if(!Storage::disk('public')->exists(self::DIRECTORY)) {
            Storage::disk('public')->makeDirectory(self::DIRECTORY);
        }
    }

    private function getFullPath(string $file_name): string
    {
        return 'app/public/' . self::DIRECTORY . '/' . $file_name;
    }

    private function getHtml(Product $product): string
    {
        return view('pdf.product-info', ['product' => $product])->render();
    }


                //->format('A4')
            //->margins(16, 16, 16, 16)
            //->showBackground()
} 