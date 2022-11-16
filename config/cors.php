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

    'paths' => ['axios/*'],

    'allowed_methods' => ['POST', 'GET', 'DELETE', 'PUT', 'PATCH'],

    'allowed_origins' => ['https://sofapt.flashvps.xyz','http://sofapt.flashvps.xyz','sofapt.flashvps.xyz','sofapt.vercel.app','http://sofapt.vercel.app','https://sofapt.vercel.app','*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 3600,

    'supports_credentials' => true,

];
