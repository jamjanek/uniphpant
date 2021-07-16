<?php
return [
    'site' => [
        'spa-site-filesystem' => [
            'application' => [
                'data_gateway' => [
                    'write' =>[
                        'meme_item' => [
                            'name' => 'meme_item',
                            'table_name' => 'meme_item',
                            "adapter_name" => "meme_db",
                        ],
                        'meme_image' => [
                            'name' => 'meme_image',
                            'table_name' => 'meme_image',
                            "adapter_name" => "meme_db",
                        ],
                        'meme_text' => [
                            'name' => 'meme_text',
                            'table_name' => 'meme_text',
                            "adapter_name" => "meme_db",
                        ],
                        'hits_item_log' => [
                            'name' => 'hits_item_log',
                            'table_name' => 'meme_text',
                            "adapter_name" => "hits_db",
                        ],
                    ], // write
                ], // data_gateway
                'data_adapter' => [
                    'meme_db' => [
                        "site_id" => 'spa-site-filesystem',
                        'name' => 'meme_db', // this matches entry in the `adapter_name` in `data_gateway`
                        'type' => 'db_adapter',
                        'driver'   => 'Pdo_Sqlite',
                        'database' =>  __DIR__ . '/../var/database/meme.sqlite3',
                    ],
                    'hits_db' => [
                        "site_id" => 'spa-site-filesystem',
                        'name' => 'hits_db',
                        'type' => 'db_adapter',
                        'driver'   => 'Pdo_Sqlite',
                        'database' =>  __DIR__ . '/../var/database/hits.sqlite3',
                    ],
                ], // data_adapter
            ], // application
        ] // spa-site-filesystem
    ] // site
];