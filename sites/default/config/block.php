<?php
return [
    'site' => [
        'config' => [
            'block' => [
                'table_gateway' => ["block"]
            ],
            'table_gateway' => [
                'block' => [
                    'name' => 'block',
                    'table_name' => 'block',
                    "adapter" => "block_db",
                ]
            ], // table_gateway
            'data_source' => [
                'block_db' => [
                    'name' => 'block_db', // this matches entry in the `table_gateway` config entry
                    "site_id" => null,
                    'type' => 'db_adapter',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ]
            ], // data_source
        ],
    ],
];