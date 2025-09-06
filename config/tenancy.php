<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tenant Model
    |--------------------------------------------------------------------------
    |
    | The model used to represent tenants.
    |
    */
    'tenant_model' => App\Models\Tenant::class,

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | These connections are used by the tenancy package to separate the
    | central and tenant databases.
    |
    */
    'database' => [
        'central_connection' => env('DB_CONNECTION', 'mysql'),
        'tenant_connection' => 'tenant',
    ],

    /*
    |--------------------------------------------------------------------------
    | Identifier Generation
    |--------------------------------------------------------------------------
    |
    | Determines how tenant IDs are generated. Using UUIDs helps avoid
    | collisions when provisioning tenants programmatically.
    |
    */
    'id_generator' => Stancl\Tenancy\UUIDGenerator::class,
];

