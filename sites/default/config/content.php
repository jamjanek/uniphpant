<?php
return [
    'site' => [
        'config' => [
            'content' => [
                'table_gateway' => ["content"]
            ],
            'table_gateway' => [
                'content' => [
                    'name' => 'content',
                    'table_name' => 'content',
                    "adapter" => "content_db",
                ]
            ], // table_gateway
            'data_source' => [
                'block_db' => [
                    'name' => 'content_db', // this matches entry in the `table_gateway` config entry
                    "site_id" => null,
                    'type' => 'db_adapter',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ]
            ], // data_source
        ],
    ],
];