<?php

return [

    'production_costs' => [
        'navigation_label' => 'Custos de Produção',
        'model_label' => 'Custo de Produção',
        'plural_model_label' => 'Custos de Produção',
        'form' => [
            'section' => [
                'title' => 'Custo de Produção',
            ],
            'title' => 'Título',
            'default' => 'Padrão',
        ],
        'table' => [
            'title' => 'Título',
            'default' => 'Padrão',
            'default_updated' => 'Padrão atualizado com sucesso',
        ],
        'infolist' => [
            'section' => [
                'title' => 'Informações',
            ],
            'title' => 'Título',
            'default' => 'Padrão',
            'expense' => 'Despesa',
            'default_true' => 'Sim',
            'default_false' => 'Não',
        ],
        'relation_managers' => [
            'expenses' => [
                'title' => 'Despesas',
                'create' => 'Adicionar Despesa',
                'form' => [
                    'title' => 'Título',
                    'value' => 'Valor',
                ],
            ],
            'productions' => [
                'title' => 'Produções',
                'create' => 'Adicionar Produção',
                'form' => [
                    'product' => 'Produto',
                    'count' => 'Quantidade',
                    'cost' => 'Custo',
                ],
                'table' => [
                    'product' => 'Produto',
                    'count' => 'Quantidade',
                    'cost' => 'C.O.',
                    'material' => 'C.I.',
                ],
            ],
        ],
    ],
    'sizes' => [
        'navigation_label' => 'Tamanhos',
        'model_label' => 'Tamanho',
        'plural_model_label' => 'Tamanhos',
        'form' => [
            'title' => 'Título',
            'alias' => 'Alias',
        ],
        'table' => [
            'title' => 'Título',
            'alias' => 'Alias',
        ],
    ],
    'colors' => [
        'navigation_label' => 'Cores',
        'model_label' => 'Cor',
        'plural_model_label' => 'Cores',
        'form' => [
            'title' => 'Título',
            'alias' => 'Alias',
        ],
        'table' => [
            'title' => 'Título',
            'alias' => 'Alias',
        ],
    ],
    'clients' => [
        'navigation_label' => 'Clientes',
        'model_label' => 'Cliente',
        'plural_model_label' => 'Clientes',
        'form' => [
            'name' => 'Nome',
            'email' => 'Email',
            'phone' => 'Telefone',
        ],
        'table' => [
            'name' => 'Nome',
            'email' => 'Email',
            'phone' => 'Telefone',
        ],
    ],
    'cutters' => [
        'navigation_label' => 'Cortadores',
        'model_label' => 'Cortador',
        'plural_model_label' => 'Cortadores',
        'form' => [
            'name' => 'Nome',
        ],
        'table' => [
            'name' => 'Nome',
        ],
    ],
    'productions' => [
        'navigation_label' => 'Produções',
        'model_label' => 'Produção',
        'plural_model_label' => 'Produções',
        'form' => [
            'product' => 'Produto',
            'cutter' => 'Cortador',
            'client' => 'Cliente',
            'color' => 'Cor',
            'date_started' => 'Data de Início',
            'date_cutting' => 'Data de Corte',
            'date_sewing' => 'Data de Costura',
            'date_finishing' => 'Data de Acabamento',
            'date_completed' => 'Data de Conclusão',
        ],
        'table' => [
            'product' => 'Produto',
            'cutter' => 'Cortador',
            'client' => 'Cliente',
            'color' => 'Cor',
            'date_started' => 'Data de Início',
            'status' => 'Status',
            'date_cutting' => 'Data de Corte',
            'date_sewing' => 'Data de Costura',
            'date_finishing' => 'Data de Acabamento',
            'date_completed' => 'Data de Conclusão',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
            'next' => 'Próximo',
            'previus' => 'Anterior',
            'filter' => [
                'status' => 'Estado da Produção',
                'button' => 'Filtrar',
                'client' => 'Cliente',
                'color' => 'Cor',
            ],
        ],
        'infolist' => [
            'section' => [
                'title' => 'Informações',
            ],
            'product' => 'Produto',
            'cutter' => 'Cortador',
            'client' => 'Cliente',
            'color' => 'Cor',
            'date_started' => 'Data de Início',
            'date_cutting' => 'Data de Corte',
            'date_sewing' => 'Data de Costura',
            'date_finishing' => 'Data de Acabamento',
            'date_completed' => 'Data de Conclusão',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ],
        'production_grids' => [
            'title' => 'Grids de Produção',
            'header_actions' => [
                'create' => 'Adicionar Grid de Produção',
            ],
        ],
    ],
    'menu' => [
        'manufacturing' => 'Fabricação',
        'variations' => 'Variações',
        'registrations' => 'Cadastros',
        'fabrication' => 'Fabricação',
    ],

];
