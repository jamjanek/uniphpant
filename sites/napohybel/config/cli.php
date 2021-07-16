<?php
return [
    'site' => [
        'napohybel' => [
            'cli' => [
                'data_gateway' => [
                    'write' =>[
                        'hits_page_log' => [
                            'name' => 'hits_page_log',
                            'table_name' => 'hits_page_log',
                            "adapter_name" => "hits_db",
                        ],
                    ], // write
                ], // data_gateway
                'data_adapter' => [
                    'hits_db' => [
                        "site_id" => 'napohybel',
                        'name' => 'hits_db',
                        'type' => 'db_adapter',
                        'driver'   => 'Pdo_Sqlite',
                        'database' =>  __DIR__ . '/../var/database/hits.sqlite3',
                    ],
                ], // data_adapter
            ], // application
        ] // napohybel
    ] // site
];