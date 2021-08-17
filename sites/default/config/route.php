<?php
return [
    'site' => [
        'config' => [
            'route' => [
                'table_gateway' => ["route"]
            ],
            'table_gateway' => [
                'route' => [
                    'name' => 'route',
                    'table_name' => 'route',
                    "data_source" => "application_database",
                ]
            ], // table_gateway
        ]
    ]
];