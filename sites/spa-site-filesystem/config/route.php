<?php
return [
    'site' => [
        'spa-site-filesystem' => [
            'route' => [
                'data_gateway' => [
                    'name' => 'route',
                    'dataset_name' => 'route',
                    "adapter_name" => "filesystem_content",
                ],
            ],
        ],
    ],
];