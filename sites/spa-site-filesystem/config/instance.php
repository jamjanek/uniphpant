<?php
return [
    'site' => [
        'spa-site-filesystem' => [
            'instance' => [
                'data_gateway' => [
                    'name' => 'instance',
                    'table_name' => 'instance',
                    "adapter_name" => "filesystem_content",
                ],
            ],
        ],
    ],
];