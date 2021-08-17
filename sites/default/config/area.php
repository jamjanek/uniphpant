<?php
return [
    'site' => [
        'config' => [
            'area' => [
                'table_gateway' => ["area"]
            ],
            'table_gateway' => [
                'area' => [
                    'name' => 'area',
                    App\Uniphpant\Domain\CommonEntity::TYPE => App\Uniphpant\SPA\Area\Domain\AreaEntity::INDEX,
                    'table_name' => 'area',
                    "data_source" => "application_database",
                ]
            ], // table_gateway
            'data_resource' =>[
                'area' => [
                    'class' => App\Uniphpant\Domain\Area\Repository\AreaReadRepositoryFactory::class,
                ],
            ], // data_resource
        ],
    ],
];