<?php
return [
    'site' => [
        'napohybel' => [
            'form' => [
                'subscribe_new' => [
                    'email' => [
                        [
                            'name' => 'email',
                            'required' => true,
                            'filters' => [
                                ['name' => 'StringTrim']
                            ],
                            'validators' => [
                                ['name' => 'NotEmpty'],
                                'strlen' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'min' => 5,
                                        'max' => 255
                                    ],
                                ]
                            ],
                        ],
                    ], // email
                ], // subscribe_new
            ], // form
        ], // napohybel
    ],
];