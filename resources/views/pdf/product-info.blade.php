<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Técnica do Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-stone-50 text-stone-900">
    <header class="border-b-2 border-b-black p-4 flex items-center gap-2">
        <i class="fas fa-file-alt text-2xl"></i>
        <h1 class="text-2xl font-bold uppercase">{{ __('Ficha Técnica de Produção Ingles') }}</h1>
        <div class="ms-auto text-sm">
            Data Emissão: <span class="font-bold block text-base">{{ '99/99/9999' }}</span>
        </div>
    </header>
    <div class="container mx-auto space-y-12 py-12">
        <section class="flex ">
            <div class="w-1/2">
                <img src="{{ asset('img/app-window.png') }}" class="border-2 border-black mx-auto">
            </div>
            <div class="w-1/2 grid grid-cols-2 ">
                
                    <div class="flex flex-col justify-center">
                        <label for="product-name" class="font-semibold">{{ __('Name') }}</label>
                        <span class="text-lg">{{ 'Produto 1' }}</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <label for="product-name" class="font-semibold">{{ __('Code') }}</label>
                        <span class="text-lg">{{ 'XPTO-001' }}</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <label for="product-name" class="font-semibold">{{ __('Status') }}</label>
                        <span class="text-lg">{{ 'Ativo' }}</span>
                    </div>
    
                    <div class="flex flex-col justify-center">
                        <label for="product-name" class="font-semibold">{{ __('created_at') }}</label>
                        <span class="text-lg">{{ '99/99/9999' }}</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <label for="product-name" class="font-semibold">{{ __('updated_at') }}</label>
                        <span class="text-lg">{{ '99/99/9999' }}</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <label for="product-name" class="font-semibold">{{ __('price') }}</label>
                        <span class="text-lg">{{ 'R$ 100,00' }}</span>
                    </div>
            </div>
        </section>
        <section class="flex gap-4 justify-center">
            <div class="flex flex-col items-center gap-2 border-2 border-black p-4">
                <span>{{ __('Fabrics') }}</span>
                <span class="text-xl font-bold">{{ 'R$ 1.000,00' }}</span>
                <span>{{ '45%' }}</span>
            </div>
            <div class="flex flex-col items-center gap-2 border-2 border-black p-4">
                <span>{{ __('Trims') }}</span>
                <span class="text-xl font-bold">{{ 'R$ 1.000,00' }}</span>
                <span>{{ '45%' }}</span>
            </div>
            <div class="flex flex-col items-center gap-2 border-2 border-black p-4">
                <span>{{ __('Linings') }}</span>
                <span class="text-xl font-bold">{{ 'R$ 1.000,00' }}</span>
                <span>{{ '45%' }}</span>
            </div>
            <div class="flex flex-col items-center gap-2 border-2 border-black p-4">
                <span>{{ __('Label') }}</span>
                <span class="text-xl font-bold">{{ 'R$ 1.000,00' }}</span>
                <span>{{ '45%' }}</span>
            </div>
            <div class="flex flex-col items-center gap-2 border-2 border-black p-4">
                <span>{{ __('Packged') }}</span>
                <span class="text-xl font-bold">{{ 'R$ 1.000,00' }}</span>
                <span>{{ '45%' }}</span>
            </div>
        </section>

        <section class="space-y-2"> 
                <table class="w-full text-left">
                    <thead class="uppercase border-b border-b-black">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/2">
                                {{ __('Shapes') }}
                            </th>
                            <th scope="col" class="px-6 py-3 w-1/2">
                                {{ __('Fabrics') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Costa
                            </th>
                            <td class="px-6 py-4">
                                Tecido1, Tecido2, Tecido3
                            </td>
                        </tr>
                        <tr class="">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Frente
                            </th>
                            <td class="px-6 py-4">
                                Tecido1, Tecido2, Tecido3
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <table class="w-full text-left">
                    <thead class="uppercase border-b border-b-black">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/2">
                                {{ __('Trims') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Quantity') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                XPTO-102
                            </th>
                            <td class="px-6 py-4">
                                3 Un.
                            </td>
                        </tr>
                        <tr class="">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                XPTO-102
                            </th>
                            <td class="px-6 py-4">
                                3 Un.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="w-full text-left">
                    <thead class="uppercase border-b border-b-black">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/2">
                                {{ __('Linigs') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Quantity') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                XPTO-102
                            </th>
                            <td class="px-6 py-4">
                                3 Un.
                            </td>
                        </tr>
                        <tr class="">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                XPTO-102
                            </th>
                            <td class="px-6 py-4">
                                3 Un.
                            </td>
                        </tr>
                    </tbody>
                </table>
        </section>
    </div>
    <footer class="border-t-2 border-t-black p-4 flex items-center gap-2 justify-center">
        Loomix
    </footer>
    
    

</body>
</html> 