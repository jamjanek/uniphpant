<?php
return [
    'site' => [
        'config' => [
            'table_gateway' => [
                'template' => [
                    'name' => 'template',
                    'table_name' => 'template',
                    "data_source" => "template_db",
                ]
            ], // table_gateway
            'data_source' => [
                'template_db' => [
                    'name' => 'template_db', // this matches entry in the `table_gateway` config entry
                    "site_id" => null,
                    'type' => 'db_adapter',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ]
            ], // data_source
            'template' => [
                'table_gateway' => ["template"]
            ]
        ]
    ]
];