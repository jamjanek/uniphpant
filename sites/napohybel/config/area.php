<?php
return [
    'site' => [
        'napohybel' => [
            'area' => [
                'gateway' => [
                    'name' => 'area',
                    'dataset' => 'area',
                    "adapter" => "filesystem_content",
                ],
                'service' => [
                    [
                        'name' => 'area',
                        'resource' => [
                            [
                                'name' => 'area_resource',
                                'class' => null,
                                'model'=>[
                                    [
                                        'name' => 'area_model',
                                        'class' => null,
                                        'adapter' => 'filesystem_content',
                                        'entity' => []
                                    ]
                                ],
                                'repository' => [
                                    [
                                        'name' => 'area_repository',
                                        'adapter' => [

                                        ],
                                        'model'=>[
                                            [
                                                'name' => 'area',
                                                'class' => '',
                                                'adapter' => 'filesystem_content',
                                                'entity' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
            ],
        ],
    ],
];