<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline@2.0.3/dist/preline.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/preline@2.0.3/dist/preline.min.js"></script>
</head>
<body class="bg-stone-50">
    <!-- Header Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-4xl mx-auto">
            <!-- Product Header -->
            <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6 md:p-10 mb-10">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <!-- Product Image -->
                    <div class="w-full md:w-1/3">
                        <img class="w-full h-auto rounded-lg shadow-lg object-cover" 
                             src="https://via.placeholder.com/400x400" 
                             alt="Calcinha de Renda">
                    </div>
                    
                    <!-- Product Info -->
                    <div class="w-full md:w-2/3">
                        <div class="flex items-center gap-3 mb-4">
                            <h1 class="text-3xl font-bold text-stone-900">Calcinha de Renda</h1>
                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800">
                                Ativo
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="space-y-2">
                                <p class="text-sm text-stone-500">Código do Produto</p>
                                <p class="font-medium text-stone-800">LNG-2024-001</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-stone-500">Status</p>
                                <p class="font-medium text-stone-800">Em Produção</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-stone-500">Data de Criação</p>
                                <p class="font-medium text-stone-800">20/03/2024</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-stone-500">Última Atualização</p>
                                <p class="font-medium text-stone-800">22/03/2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custos Section -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6">
                    <div class="flex items-center gap-x-4">
                        <div class="inline-flex justify-center items-center w-12 h-12 rounded-lg bg-cyan-100">
                            <svg class="w-6 h-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase font-medium text-stone-500">Custo de Tecidos</p>
                            <p class="text-xl font-bold text-stone-800">R$ 25,50</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6">
                    <div class="flex items-center gap-x-4">
                        <div class="inline-flex justify-center items-center w-12 h-12 rounded-lg bg-cyan-100">
                            <svg class="w-6 h-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase font-medium text-stone-500">Custo de Insumos</p>
                            <p class="text-xl font-bold text-stone-800">R$ 12,30</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6">
                    <div class="flex items-center gap-x-4">
                        <div class="inline-flex justify-center items-center w-12 h-12 rounded-lg bg-cyan-100">
                            <svg class="w-6 h-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase font-medium text-stone-500">Custo Total</p>
                            <p class="text-xl font-bold text-stone-800">R$ 37,80</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ficha Técnica Section -->
            <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6 md:p-10 mb-10">
                <h2 class="text-2xl font-bold text-stone-900 mb-6">Ficha Técnica</h2>
                
                <!-- Moldes e Tecidos -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-stone-800 mb-4">Moldes e Tecidos</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-200">
                            <thead>
                                <tr class="bg-stone-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Molde</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Tecido</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Consumo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm text-stone-800">Frente</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">Renda Floral</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">0,15m</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-stone-800">Costas</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">Renda Floral</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">0,20m</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aviamentos -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-stone-800 mb-4">Aviamentos</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-200">
                            <thead>
                                <tr class="bg-stone-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Item</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Quantidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Unidade</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm text-stone-800">Elástico</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">1,2</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">metros</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-stone-800">Lacinho</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">1</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">unidade</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Forros -->
                <div>
                    <h3 class="text-lg font-semibold text-stone-800 mb-4">Forros</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-200">
                            <thead>
                                <tr class="bg-stone-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Tipo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Material</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Consumo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm text-stone-800">Forro Interno</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">Algodão</td>
                                    <td class="px-6 py-4 text-sm text-stone-800">0,25m</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 