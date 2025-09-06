<?php

return [
    'default' => env('BROADCAST_CONNECTION', 'log'),

    'connections' => [
        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],
    ],
];

