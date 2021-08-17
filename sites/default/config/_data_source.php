<?php
return [
    'site' => [
        'config' => [
            'data_source' => [
                'application_database' => [
                    'name' => 'application_database', // this matches entry in the `table_gateway` config entry
                    "site_id" => $_ENV['SITE_ID'],
                    'type' => 'database',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../../../var/data/database/content-default--development.sqlite3',
                ], // database
                'site_database' => [
                    'name' => 'site_database', // this matches entry in the `table_gateway` config entry
                    "site_id" => $_ENV['SITE_ID'],
                    'type' => 'database',
                    'driver'   => 'Pdo_Sqlite',
                    'database' =>  __DIR__ . '/../var/database/content-default--development.sqlite3',
                ], // another_database
                'user_files' => [
                    'name' => 'user_files', // this matches entry in the `table_gateway` config entry
                    "site_id" => $_ENV['SITE_ID'],
                    'type' => 'filesystem',
                    'driver'   => [
                        'glob_paths' => __DIR__ . '/../site.{json,yaml,php}',
                        'cache' => [
                            'cache_enabled' => false,
                            'cache_perm' => 665,
                            'cache_dir' => __DIR__ . '/../var/cache/',
                            'cache_key' => 'site_user_files_cache',
                        ],
                    ],
                ], // user_files
                'some_api' => [
                    'name' => 'some_api', // this matches entry in the `table_gateway` config entry
                    "site_id" => $_ENV['SITE_ID'],
                    'type' => 'api',
                    'client' => [
                        'github' => [
                            'host' => [
                                'url' => 'https://api.github.com',
                            ],
                            'headers' => [
                                'accept' => 'application/vnd.github.v3+json',
                                'content-type' => 'application/json',
                            ],
                            'endpoints' => [
                                'repo' => [
                                    'type' => 'get',
                                    'name' => 'repo',
                                    'uri'=>'/repos/%s',
                                ],
                            ],
                            'extra'=>[
                                'rate_limit' => [
                                    'url' => '/rate_limit',
                                ],
                            ],
                        ], // github
                    ], // client
                ], // some_api
            ], // data_source
        ],
    ],
];