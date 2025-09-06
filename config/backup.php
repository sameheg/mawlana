<?php

return [
    'backup' => [
        'name' => env('APP_NAME', 'laravel-backup'),
        'source' => [
            'files' => [
                'include' => [
                    base_path(),
                ],
                'exclude' => [
                    base_path('vendor'),
                    base_path('node_modules'),
                ],
                'follow_links' => false,
            ],
            'databases' => [
                env('DB_CONNECTION', 'mysql'),
            ],
        ],
        'destination' => [
            'disks' => ['s3'],
        ],
    ],
];
