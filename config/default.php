<?php

$config = [
    'debug' => false,
    'twig.options' => [
        'twig.path' => [APP_ROOT . 'views'],
    ],
    'supervisor.options' => [
        'instances' => [
            'default' => [
                'host' => '127.0.0.1',
                'port' => 9001
            ]
        ]
    ]
];
