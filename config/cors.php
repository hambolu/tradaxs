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
        'api/auth/login',
        'api/auth/register',
        'api/createWallet',
        'api/allusers',
        'api/merchantoffers',
        'api/transactions',
        'api/myWallets',
        'api/users',
        'api/wallets',
        'api/createOffer',
        'api/buyOffer',
        'api/auth/logout'
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['api.tradaxs.com','localhost:8081','localhost:8000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
