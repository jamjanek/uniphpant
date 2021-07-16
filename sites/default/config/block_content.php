<?php
return [
    'site' => [
        'config' => [
            'block_content' => [
                'table_gateway' => ["block_content"]
            ],
            'table_gateway' => [
                'block_content' => [
                    'name' => 'block_content',
                    'table_name' => 'block_content',
                    "data_source" => "block_content_db",
                ]
            ], // table_gateway
            'data_source' => [
                'block_content_db' => [
                    'name' => 'block_content_db', // this matches entry in the `table_gateway` config entry
                    "site_id" => null,
                    'type' => 'db_adapter',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ]
            ], // data_source
        ], // config
    ], // site
];