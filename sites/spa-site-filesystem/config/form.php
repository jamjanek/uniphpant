<?php
return [
    'site' => [
        'spa-site-filesystem' => [
            'form' => [
                'create' => [
                    'character' => [
                        [
                            'name' => 'character',
                            'required' => true,
                            'filters' => [
                                ['name' => 'StringTrim']
                            ],
                            'validators' => [
                                [
                                    'name' => 'NotEmpty'
                                ],
                                'strlen' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'min' => 1,
                                        'max' => 1
                                    ],
                                ]
                            ],
                            'value' => 1,
                            'image_placeholder' => '/assets/images/source/source-1_sample.png',
                            'image_placeholder_url_path' => '/assets/images/source/',

                        ]
                    ],
                    'text' => [
                        [
                            'name' => 'text_1',
                            'required' => true,
                            'label' => '2. Wpisz tre&#347;&#263; paska:',
                            'filters' => [
                                ['name' => 'StringTrim']
                            ],
                            'validators' => [
                                [
                                    'name' => 'NotEmpty'
                                ],
                                'strlen' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'min' => 1,
                                        'max' => 48
                                    ],
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],
];