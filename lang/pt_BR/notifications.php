<?php

return [

    'success' => 'Sucesso',
    'error' => 'Erro',
    'warning' => 'Atenção',
    'info' => 'Informação',
    'default' => 'Padrão',
    'default_updated' => 'Padrão atualizado com sucesso',
    'default_updated_error' => 'Erro ao atualizar o padrão',
    'default_updated_warning' => 'Atenção ao atualizar o padrão',

    'production' => [
        'observer' => [
            'production_updated' => 'Produção atualizada com sucesso',
        ],
    ],

    'body' => [
        'actions' => [
            'production_cost_packge_auto_build' => 'Pacote de produção criado com sucesso',
        ],
        'resources' => [
            'products' => [
                'relation_managers' => [
                    'product_arrangements' => [
                        'table' => [
                            'created' => 'Arranjo criado com sucesso',
                            'default_updated' => 'Arranjo padrão atualizado com sucesso',
                            'at_least_one_default_required' => 'Pelo menos um arranjo deve ser padrão',
                            'arrangement_already_exists' => 'Arranjo já existe',
                        ],
                    ],
                ],
            ],
        ],
        'observer' => [
            'product_arrangement' => [
                'at_least_one_default_required' => 'Pelo menos um arranjo deve ser padrão',
            ],
        ],
    ],

];
