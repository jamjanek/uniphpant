<?php
return [
    'site' => [
        'spa-site-filesystem' => [
            'router' => [
                'data_gateway' => [
                    "read" => [
                        'name' => 'router',
                        'dataset_name' => 'router',
                        "adapter_type" => "filesystem_json",
                        "path" => __DIR__ . "../data/data-router.json",
                    ]
                ],
            ],
        ],
    ],
];