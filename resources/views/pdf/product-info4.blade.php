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
            border-bottom: 4px solid #0891b2;
            background: linear-gradient(135deg, #f0fdff 0%, #ecfeff 100%);
        }
        
        .section-divider {
            border-left: 5px solid #0891b2;
            padding-left: 1.25rem;
            background: linear-gradient(90deg, rgba(8, 145, 178, 0.08) 0%, transparent 100%);
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .table-header {
            background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        }
        
        .table-header-secondary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        
        .cost-card-primary {
            background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%);
            border: 2px solid #a5f3fc;
        }
        
        .cost-card-secondary {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 2px solid #93c5fd;
        }
        
        .cost-card-neutral {
            background: linear-gradient(135deg, #fafaf9 0%, #f5f5f4 100%);
            border: 2px solid #d6d3d1;
        }
        
        .status-badge-active {
            background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        }
        
        .status-badge-approved {
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
        }
        
        .info-badge {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        
        @media print {
            body { print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-stone-50 text-stone-900">
    <div class="max-w-5xl mx-auto bg-white shadow-xl min-h-screen border border-stone-200">
        <!-- Document Header -->
        <div class="document-header px-8 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-3">
                        <div class="p-3 bg-white rounded-xl shadow-md border border-cyan-100">
                            <i class="fas fa-file-alt text-2xl text-cyan-600"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-stone-900">FICHA TÉCNICA DO PRODUTO</h1>
                            <p class="text-stone-600 font-medium">Documento técnico detalhado - Departamento de Desenvolvimento</p>
                        </div>
                    </div>
                </div>
                <div class="text-right bg-white px-4 py-3 rounded-xl shadow-md border border-stone-200">
                    <p class="text-sm text-stone-500 font-medium">Data de Emissão</p>
                    <p class="font-bold text-stone-800">{{ date('d/m/Y H:i') }}</p>
                    <p class="text-xs text-cyan-600 font-medium mt-1">Versão 1.2</p>
                </div>
            </div>
        </div>

        <div class="px-8 py-6">
            <!-- Product Information Section -->
            <section class="mb-10">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-6">1. INFORMAÇÕES GERAIS DO PRODUTO</h2>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Product Image -->
                    <div class="md:col-span-1">
                        <div class="bg-gradient-to-br from-stone-50 to-stone-100 rounded-xl p-6 border-2 border-stone-200 shadow-sm">
                            <img class="w-full h-64 object-cover rounded-lg shadow-md border border-stone-200" 
                                 src="https://via.placeholder.com/300x400" 
                                 alt="Calcinha de Renda">
                            <div class="mt-4 text-center">
                                <span class="inline-flex items-center gap-2 px-4 py-2 status-badge-approved text-white text-sm font-semibold rounded-lg shadow-md">
                                    <i class="fas fa-check-circle"></i>
                                    APROVADO
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="md:col-span-2">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-5">
                                <div class="bg-gradient-to-r from-cyan-50 to-cyan-25 rounded-lg p-4 border border-cyan-200">
                                    <label class="text-xs font-bold text-cyan-700 uppercase tracking-wide">Nome do Produto</label>
                                    <p class="font-bold text-stone-900 text-lg">Calcinha de Renda Premium</p>
                                </div>
                                <div class="bg-gradient-to-r from-blue-50 to-blue-25 rounded-lg p-4 border border-blue-200">
                                    <label class="text-xs font-bold text-blue-700 uppercase tracking-wide">Código</label>
                                    <p class="font-bold text-stone-900 text-lg font-mono">LNG-2024-001</p>
                                </div>
                                <div class="bg-gradient-to-r from-stone-50 to-stone-25 rounded-lg p-4 border border-stone-200">
                                    <label class="text-xs font-bold text-stone-700 uppercase tracking-wide">Categoria</label>
                                    <p class="font-bold text-stone-900">Lingerie Premium</p>
                                </div>
                                <div class="bg-gradient-to-r from-cyan-50 to-cyan-25 rounded-lg p-4 border border-cyan-200">
                                    <label class="text-xs font-bold text-cyan-700 uppercase tracking-wide">Status</label>
                                    <span class="inline-flex items-center gap-2 px-3 py-1 status-badge-active text-white text-sm font-semibold rounded-md shadow-sm mt-2">
                                        <i class="fas fa-play-circle"></i>
                                        Ativo
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-5">
                                <div class="bg-gradient-to-r from-stone-50 to-stone-25 rounded-lg p-4 border border-stone-200">
                                    <label class="text-xs font-bold text-stone-700 uppercase tracking-wide">Data de Criação</label>
                                    <p class="font-bold text-stone-900">20/03/2024</p>
                                </div>
                                <div class="bg-gradient-to-r from-blue-50 to-blue-25 rounded-lg p-4 border border-blue-200">
                                    <label class="text-xs font-bold text-blue-700 uppercase tracking-wide">Última Revisão</label>
                                    <p class="font-bold text-stone-900">22/03/2024</p>
                                </div>
                                <div class="bg-gradient-to-r from-stone-50 to-stone-25 rounded-lg p-4 border border-stone-200">
                                    <label class="text-xs font-bold text-stone-700 uppercase tracking-wide">Responsável</label>
                                    <p class="font-bold text-stone-900">Equipe de Desenvolvimento</p>
                                </div>
                                <div class="bg-gradient-to-r from-cyan-50 to-cyan-25 rounded-lg p-4 border border-cyan-200">
                                    <label class="text-xs font-bold text-cyan-700 uppercase tracking-wide">Revisão</label>
                                    <p class="font-bold text-stone-900 font-mono">v1.2</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cost Analysis Section -->
            <section class="mb-10">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-6">2. ANÁLISE DE CUSTOS</h2>
                
                <div class="grid md:grid-cols-4 gap-5 mb-8">
                    <div class="cost-card-primary rounded-xl p-6 text-center shadow-md">
                        <div class="flex justify-center mb-3">
                            <div class="p-3 bg-white rounded-xl shadow-sm border border-cyan-200">
                                <i class="fas fa-cut text-cyan-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-xs text-cyan-700 font-bold mb-2 uppercase tracking-wide">TECIDOS</p>
                        <p class="text-2xl font-bold text-cyan-900 mb-1">R$ 25,50</p>
                        <p class="text-sm text-cyan-600 font-semibold">67.5%</p>
                    </div>
                    <div class="cost-card-secondary rounded-xl p-6 text-center shadow-md">
                        <div class="flex justify-center mb-3">
                            <div class="p-3 bg-white rounded-xl shadow-sm border border-blue-200">
                                <i class="fas fa-tools text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-xs text-blue-700 font-bold mb-2 uppercase tracking-wide">AVIAMENTOS</p>
                        <p class="text-2xl font-bold text-blue-900 mb-1">R$ 8,30</p>
                        <p class="text-sm text-blue-600 font-semibold">22.0%</p>
                    </div>
                    <div class="cost-card-secondary rounded-xl p-6 text-center shadow-md">
                        <div class="flex justify-center mb-3">
                            <div class="p-3 bg-white rounded-xl shadow-sm border border-blue-200">
                                <i class="fas fa-layer-group text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-xs text-blue-700 font-bold mb-2 uppercase tracking-wide">FORROS</p>
                        <p class="text-2xl font-bold text-blue-900 mb-1">R$ 4,00</p>
                        <p class="text-sm text-blue-600 font-semibold">10.5%</p>
                    </div>
                    <div class="cost-card-neutral rounded-xl p-6 text-center shadow-md">
                        <div class="flex justify-center mb-3">
                            <div class="p-3 bg-white rounded-xl shadow-sm border border-stone-300">
                                <i class="fas fa-calculator text-stone-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-xs text-stone-700 font-bold mb-2 uppercase tracking-wide">TOTAL</p>
                        <p class="text-2xl font-bold text-stone-900 mb-1">R$ 37,80</p>
                        <p class="text-sm text-stone-600 font-semibold">100%</p>
                    </div>
                </div>
            </section>

            <!-- Technical Specifications Section -->
            <section class="mb-10">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-6">3. ESPECIFICAÇÕES TÉCNICAS</h2>
                
                <!-- Moldes e Tecidos -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-stone-800 mb-4 flex items-center gap-3">
                        <div class="p-2 bg-cyan-100 rounded-lg">
                            <i class="fas fa-puzzle-piece text-cyan-600"></i>
                        </div>
                        3.1 Moldes e Tecidos
                    </h3>
                    <div class="overflow-x-auto shadow-lg rounded-xl border border-stone-200">
                        <table class="w-full">
                            <thead class="table-header text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Componente</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Tipo de Tecido</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Consumo (m)</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Observações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 bg-white">
                                <tr class="hover:bg-cyan-25 transition-colors">
                                    <td class="px-6 py-4 font-bold text-stone-900">Frente</td>
                                    <td class="px-6 py-4 text-stone-700">Renda Floral Premium</td>
                                    <td class="px-6 py-4 font-mono font-bold text-cyan-700">0,15</td>
                                    <td class="px-6 py-4 text-sm text-stone-600">Corte em viés</td>
                                </tr>
                                <tr class="hover:bg-cyan-25 transition-colors">
                                    <td class="px-6 py-4 font-bold text-stone-900">Costas</td>
                                    <td class="px-6 py-4 text-stone-700">Renda Floral Premium</td>
                                    <td class="px-6 py-4 font-mono font-bold text-cyan-700">0,20</td>
                                    <td class="px-6 py-4 text-sm text-stone-600">Mesma estampa da frente</td>
                                </tr>
                                <tr class="hover:bg-cyan-25 transition-colors">
                                    <td class="px-6 py-4 font-bold text-stone-900">Laterais</td>
                                    <td class="px-6 py-4 text-stone-700">Elástico Decorativo</td>
                                    <td class="px-6 py-4 font-mono font-bold text-cyan-700">0,10</td>
                                    <td class="px-6 py-4 text-sm text-stone-600">Largura 12mm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Aviamentos -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-stone-800 mb-4 flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i class="fas fa-cogs text-blue-600"></i>
                        </div>
                        3.2 Aviamentos e Acessórios
                    </h3>
                    <div class="overflow-x-auto shadow-lg rounded-xl border border-stone-200">
                        <table class="w-full">
                            <thead class="table-header-secondary text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Item</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Especificação</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Quantidade</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Unidade</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Fornecedor</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 bg-white">
                                <tr class="hover:bg-blue-25 transition-colors">
                                    <td class="px-6 py-4 font-bold text-stone-900">Elástico Premium</td>
                                    <td class="px-6 py-4 text-stone-700">8mm largura, cor nude</td>
                                    <td class="px-6 py-4 font-mono font-bold text-blue-700">1,2</td>
                                    <td class="px-6 py-4 text-stone-700">metros</td>
                                    <td class="px-6 py-4 text-sm font-medium text-blue-600">Elastex Ltda</td>
                                </tr>
                                <tr class="hover:bg-blue-25 transition-colors">
                                    <td class="px-6 py-4 font-bold text-stone-900">Lacinho Decorativo</td>
                                    <td class="px-6 py-4 text-stone-700">Cetim premium, rosa</td>
                                    <td class="px-6 py-4 font-mono font-bold text-blue-700">1</td>
                                    <td class="px-6 py-4 text-stone-700">unidade</td>
                                    <td class="px-6 py-4 text-sm font-medium text-blue-600">Aviamentos Finos</td>
                                </tr>
                                <tr class="hover:bg-blue-25 transition-colors">
                                    <td class="px-6 py-4 font-bold text-stone-900">Linha de Costura</td>
                                    <td class="px-6 py-4 text-stone-700">Polyester 120, cor nude</td>
                                    <td class="px-6 py-4 font-mono font-bold text-blue-700">50</td>
                                    <td class="px-6 py-4 text-stone-700">metros</td>
                                    <td class="px-6 py-4 text-sm font-medium text-blue-600">Coats Corrente</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Forros -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-stone-800 mb-4 flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i class="fas fa-shield-alt text-blue-600"></i>
                        </div>
                        3.3 Forros e Revestimentos
                    </h3>
                    <div class="overflow-x-auto shadow-lg rounded-xl border border-stone-200">
                        <table class="w-full">
                            <thead class="table-header-secondary text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Tipo</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Material</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Consumo (m)</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold">Certificações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 bg-white">
                                <tr class="hover:bg-blue-25 transition-colors">
                                    <td class="px-6 py-4 font-bold text-stone-900">Forro Interno</td>
                                    <td class="px-6 py-4 text-stone-700">100% Algodão Orgânico</td>
                                    <td class="px-6 py-4 font-mono font-bold text-blue-700">0,25</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <span class="px-3 py-1 bg-teal-100 text-teal-700 text-xs font-bold rounded-full">OEKO-TEX</span>
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">GOTS</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Quality Standards Section -->
            <section class="mb-10">
                <h2 class="section-divider text-xl font-bold text-stone-900 mb-6">4. PADRÕES DE QUALIDADE</h2>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-gradient-to-br from-cyan-50 to-cyan-25 rounded-xl p-6 border-2 border-cyan-200 shadow-md">
                        <h4 class="font-bold text-stone-800 mb-4 flex items-center gap-3">
                            <div class="p-2 bg-yellow-100 rounded-lg">
                                <i class="fas fa-medal text-yellow-600"></i>
                            </div>
                            Certificações de Qualidade
                        </h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center gap-3 p-2 bg-white rounded-lg border border-cyan-100">
                                <i class="fas fa-check text-teal-600 text-lg"></i>
                                <span class="font-medium text-stone-700">ISO 9001:2015 - Sistema de Gestão da Qualidade</span>
                            </li>
                            <li class="flex items-center gap-3 p-2 bg-white rounded-lg border border-cyan-100">
                                <i class="fas fa-check text-teal-600 text-lg"></i>
                                <span class="font-medium text-stone-700">OEKO-TEX Standard 100 - Segurança Têxtil</span>
                            </li>
                            <li class="flex items-center gap-3 p-2 bg-white rounded-lg border border-cyan-100">
                                <i class="fas fa-check text-teal-600 text-lg"></i>
                                <span class="font-medium text-stone-700">GOTS - Global Organic Textile Standard</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-blue-25 rounded-xl p-6 border-2 border-blue-200 shadow-md">
                        <h4 class="font-bold text-stone-800 mb-4 flex items-center gap-3">
                            <div class="p-2 bg-stone-100 rounded-lg">
                                <i class="fas fa-cog text-stone-600"></i>
                            </div>
                            Especificações de Produção
                        </h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between items-center p-2 bg-white rounded-lg border border-blue-100">
                                <span class="font-medium text-stone-700">Costura:</span>
                                <span class="font-bold text-blue-700">Overloque 4 fios</span>
                            </li>
                            <li class="flex justify-between items-center p-2 bg-white rounded-lg border border-blue-100">
                                <span class="font-medium text-stone-700">Acabamento:</span>
                                <span class="font-bold text-blue-700">Barra francesa</span>
                            </li>
                            <li class="flex justify-between items-center p-2 bg-white rounded-lg border border-blue-100">
                                <span class="font-medium text-stone-700">Controle:</span>
                                <span class="font-bold text-blue-700">100% inspecionado</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Document Footer -->
            <footer class="border-t-2 border-stone-200 pt-6 mt-10 bg-gradient-to-r from-stone-50 to-stone-25 -mx-8 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div class="space-y-1">
                        <p class="text-sm font-bold text-stone-800">
                            <span class="text-cyan-600">Documento:</span> FT-LNG-2024-001
                        </p>
                        <p class="text-sm font-bold text-stone-800">
                            <span class="text-blue-600">Revisão:</span> 1.2 | 
                            <span class="text-blue-600">Data:</span> 22/03/2024
                        </p>
                    </div>
                    <div class="text-right space-y-1">
                        <p class="text-sm font-bold text-stone-800">Departamento de Desenvolvimento de Produtos</p>
                        <p class="text-xs font-semibold text-stone-600 info-badge px-3 py-1 rounded-full text-white">
                            Confidencial - Uso Interno
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html> 