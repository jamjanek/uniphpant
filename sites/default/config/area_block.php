<?php
return [
    'site' => [
        'config' => [
            'area_block' => [
                'table_gateway' => ["area_block"]
            ],
            'table_gateway' => [
                'area_block' => [
                    'name' => 'area_block',
                    'table_name' => 'area_block',
                    "data_source" => "area_block_db",
                ]
            ], // table_gateway
            'data_source' => [
                'area_block_db' => [
                    'name' => 'area_block_db', // this matches entry in the `table_gateway` config entry
                    "site_id" => null,
                    'type' => 'db_adapter',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ]
            ], // data_source
        ],
    ],
];