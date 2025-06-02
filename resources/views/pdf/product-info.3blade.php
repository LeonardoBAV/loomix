<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Técnica do Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .document-header {
            border-bottom: 3px solid #0891b2;
        }
        
        .section-divider {
            border-left: 4px solid #0891b2;
            padding-left: 1rem;
        }
        
        .table-header {
            background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        }
        
        @media print {
            body { print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-stone-50 text-stone-900">
    <div class="max-w-5xl mx-auto bg-white shadow-lg min-h-screen">
        <!-- Document Header -->
        <div class="document-header bg-white px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-file-alt text-2xl text-cyan-600"></i>
                        <h1 class="text-2xl font-bold text-stone-900">FICHA TÉCNICA DO PRODUTO</h1>
                    </div>
                    <p class="text-stone-600">Documento técnico detalhado - Departamento de Desenvolvimento</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-stone-500">Data de Emissão</p>
                    <p class="font-semibold text-stone-800">{{ date('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="px-8 py-6">
            <!-- Product Information Section -->
            <section class="mb-8">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-4">1. INFORMAÇÕES GERAIS DO PRODUTO</h2>
                
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Product Image -->
                    <div class="md:col-span-1">
                        <div class="bg-stone-50 rounded-lg p-4 border border-stone-200">
                            <img class="w-full h-64 object-cover rounded" 
                                 src="https://via.placeholder.com/300x400" 
                                 alt="Calcinha de Renda">
                            <div class="mt-3 text-center">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded">
                                    <i class="fas fa-check-circle"></i>
                                    APROVADO
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="md:col-span-2">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Nome do Produto</label>
                                    <p class="font-semibold text-stone-900">Calcinha de Renda Premium</p>
                                </div>
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Código</label>
                                    <p class="font-semibold text-stone-900">LNG-2024-001</p>
                                </div>
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Categoria</label>
                                    <p class="font-semibold text-stone-900">Lingerie Premium</p>
                                </div>
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Status</label>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-cyan-100 text-cyan-800 text-xs font-medium rounded">
                                        <i class="fas fa-play-circle"></i>
                                        Ativo
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Data de Criação</label>
                                    <p class="font-semibold text-stone-900">20/03/2024</p>
                                </div>
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Última Revisão</label>
                                    <p class="font-semibold text-stone-900">22/03/2024</p>
                                </div>
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Responsável</label>
                                    <p class="font-semibold text-stone-900">Equipe de Desenvolvimento</p>
                                </div>
                                <div>
                                    <label class="text-xs font-medium text-stone-500 uppercase">Versão</label>
                                    <p class="font-semibold text-stone-900">v1.2</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cost Analysis Section -->
            <section class="mb-8">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-4">2. ANÁLISE DE CUSTOS</h2>
                
                <div class="grid md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-4 text-center">
                        <i class="fas fa-cut text-cyan-600 text-lg mb-2"></i>
                        <p class="text-xs text-cyan-700 font-medium mb-1">TECIDOS</p>
                        <p class="text-xl font-bold text-cyan-900">R$ 25,50</p>
                        <p class="text-xs text-cyan-600">67.5%</p>
                    </div>
                    <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 text-center">
                        <i class="fas fa-tools text-emerald-600 text-lg mb-2"></i>
                        <p class="text-xs text-emerald-700 font-medium mb-1">AVIAMENTOS</p>
                        <p class="text-xl font-bold text-emerald-900">R$ 8,30</p>
                        <p class="text-xs text-emerald-600">22.0%</p>
                    </div>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
                        <i class="fas fa-layer-group text-purple-600 text-lg mb-2"></i>
                        <p class="text-xs text-purple-700 font-medium mb-1">FORROS</p>
                        <p class="text-xl font-bold text-purple-900">R$ 4,00</p>
                        <p class="text-xs text-purple-600">10.5%</p>
                    </div>
                    <div class="bg-stone-100 border border-stone-300 rounded-lg p-4 text-center">
                        <i class="fas fa-calculator text-stone-600 text-lg mb-2"></i>
                        <p class="text-xs text-stone-700 font-medium mb-1">TOTAL</p>
                        <p class="text-xl font-bold text-stone-900">R$ 37,80</p>
                        <p class="text-xs text-stone-600">100%</p>
                    </div>
                </div>
            </section>

            <!-- Technical Specifications Section -->
            <section class="mb-8">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-4">3. ESPECIFICAÇÕES TÉCNICAS</h2>
                
                <!-- Moldes e Tecidos -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-stone-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-puzzle-piece text-cyan-600"></i>
                        3.1 Moldes e Tecidos
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-stone-200 rounded-lg overflow-hidden">
                            <thead class="table-header text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Componente</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Tipo de Tecido</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Consumo (m)</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Observações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 bg-white">
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-medium">Frente</td>
                                    <td class="px-4 py-3">Renda Floral Premium</td>
                                    <td class="px-4 py-3 font-mono">0,15</td>
                                    <td class="px-4 py-3 text-sm text-stone-600">Corte em viés</td>
                                </tr>
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-medium">Costas</td>
                                    <td class="px-4 py-3">Renda Floral Premium</td>
                                    <td class="px-4 py-3 font-mono">0,20</td>
                                    <td class="px-4 py-3 text-sm text-stone-600">Mesma estampa da frente</td>
                                </tr>
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-medium">Laterais</td>
                                    <td class="px-4 py-3">Elástico Decorativo</td>
                                    <td class="px-4 py-3 font-mono">0,10</td>
                                    <td class="px-4 py-3 text-sm text-stone-600">Largura 12mm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aviamentos -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-stone-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-cogs text-emerald-600"></i>
                        3.2 Aviamentos e Acessórios
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-stone-200 rounded-lg overflow-hidden">
                            <thead class="table-header text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Item</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Especificação</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Quantidade</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Unidade</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Fornecedor</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 bg-white">
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-medium">Elástico Premium</td>
                                    <td class="px-4 py-3">8mm largura, cor nude</td>
                                    <td class="px-4 py-3 font-mono">1,2</td>
                                    <td class="px-4 py-3">metros</td>
                                    <td class="px-4 py-3 text-sm">Elastex Ltda</td>
                                </tr>
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-medium">Lacinho Decorativo</td>
                                    <td class="px-4 py-3">Cetim premium, rosa</td>
                                    <td class="px-4 py-3 font-mono">1</td>
                                    <td class="px-4 py-3">unidade</td>
                                    <td class="px-4 py-3 text-sm">Aviamentos Finos</td>
                                </tr>
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-medium">Linha de Costura</td>
                                    <td class="px-4 py-3">Polyester 120, cor nude</td>
                                    <td class="px-4 py-3 font-mono">50</td>
                                    <td class="px-4 py-3">metros</td>
                                    <td class="px-4 py-3 text-sm">Coats Corrente</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Forros -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-stone-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-shield-alt text-purple-600"></i>
                        3.3 Forros e Revestimentos
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-stone-200 rounded-lg overflow-hidden">
                            <thead class="table-header text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Tipo</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Material</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Consumo (m)</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Certificações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 bg-white">
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-medium">Forro Interno</td>
                                    <td class="px-4 py-3">100% Algodão Orgânico</td>
                                    <td class="px-4 py-3 font-mono">0,25</td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-1">
                                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs rounded">OEKO-TEX</span>
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded">GOTS</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Quality Standards Section -->
            <section class="mb-8">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-4">4. PADRÕES DE QUALIDADE</h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-stone-50 rounded-lg p-4 border border-stone-200">
                        <h4 class="font-semibold text-stone-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-medal text-yellow-600"></i>
                            Certificações
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check text-emerald-600"></i>
                                ISO 9001:2015 - Sistema de Gestão da Qualidade
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check text-emerald-600"></i>
                                OEKO-TEX Standard 100 - Segurança Têxtil
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check text-emerald-600"></i>
                                GOTS - Global Organic Textile Standard
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-stone-50 rounded-lg p-4 border border-stone-200">
                        <h4 class="font-semibold text-stone-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-cog text-stone-600"></i>
                            Especificações de Produção
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex justify-between">
                                <span>Costura:</span>
                                <span class="font-medium">Overloque 4 fios</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Acabamento:</span>
                                <span class="font-medium">Barra francesa</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Controle:</span>
                                <span class="font-medium">100% inspecionado</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Document Footer -->
            <footer class="border-t border-stone-200 pt-4 mt-8">
                <div class="flex justify-between items-center text-sm text-stone-600">
                    <div>
                        <p><strong>Documento:</strong> FT-LNG-2024-001</p>
                        <p><strong>Revisão:</strong> 1.2 | <strong>Data:</strong> 22/03/2024</p>
                    </div>
                    <div class="text-right">
                        <p>Departamento de Desenvolvimento de Produtos</p>
                        <p>Confidencial - Uso Interno</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html> 