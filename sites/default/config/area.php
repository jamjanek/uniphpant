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
                    'table_name' => 'area',
                    "data_source" => "area_db",
                ]
            ], // table_gateway
            'data_source' => [
                'area_db' => [
                    'name' => 'area_db', // this matches entry in the `table_gateway` config entry
                    "site_id" => null,
                    'type' => 'db_adapter',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ]
            ], // data_source
        ],
    ],
];