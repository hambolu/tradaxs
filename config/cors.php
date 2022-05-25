<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => [
        'api/v1/auth/login',
        'api/v1/auth/register',
        'api/v1/createWallet',
        'api/v1/create_wallet',
        'api/v1/allusers',
        'api/v1/merchantoffers',
        'api/v1/transactions',
        'api/v1/myWallets',
        'api/v1/users',
        'api/v1/wallets',
        'api/v1/createOffer',
        'api/v1/buyOffer',
        'api/v1/auth/logout'
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['api.tradaxs.com','localhost:8081','localhost:8000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
