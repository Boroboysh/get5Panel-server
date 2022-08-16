<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default RCON Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the RCON connections below you wish
    | to use as your default connection for all RCON work.
    |
    */

    'default' => env('RCON_CONNECTION', 'default'),

    /*
    |--------------------------------------------------------------------------
    | RCON Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the RCON connections setup for your application.
    |
    */

    'connections' => [
        'csgo' => [
            'host' => env('RCON_HOST', '217.116.52.85'),
            'port' => env('RCON_PORT', 27115),
            'password' => env('RCON_PASSWORD', "89829817111"),
            'timeout' => env('RCON_TIMEOUT', 60)
        ],
        'default' => [
            'host' => env('RCON_HOST', 'localhost'),
            'port' => env('RCON_PORT', 27015),
            'password' => env('RCON_PASSWORD', null),
            'timeout' => env('RCON_TIMEOUT', 60)
        ],

    ]

];
