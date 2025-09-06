<?php

return [
    'secret' => env('JWT_SECRET', 'change-me'),
    'ttl' => env('JWT_TTL', 3600),
];

