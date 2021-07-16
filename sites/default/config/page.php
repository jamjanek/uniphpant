<?php
return [
    'site' => [
        'config' => [
            'table_gateway' => [
                'page' => [
                    'name' => 'page',
                    'table_name' => 'page',
                    "data_source" => "page_db",
                ]
            ], // table_gateway
            'data_source' => [
                'page_db' => [
                    'name' => 'page_db', // this matches entry in the `table_gateway` config entry
                    "site_id" => null,
                    'type' => 'db_adapter',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ]
            ], // data_source
            'page' => [
                'table_gateway' => ["page"]
            ]
        ]
    ]
];