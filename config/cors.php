<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | This file was generated to allow cross-origin requests to your application.
    | You can adjust these settings as needed. For more information, refer to:
    | https://laravel.com/docs/laravel-cors
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*
    |--------------------------------------------------------------------------
    | Allowed HTTP methods
    |--------------------------------------------------------------------------
    |
    | For each incoming request, if the HTTP method matches one of these values,
    | CORS headers will be added. Use ['*'] to allow all methods.
    |
    */
    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed origins
    |--------------------------------------------------------------------------
    |
    | You may specify one or more origins that should be allowed to make
    | cross-origin requests to your application. For example:
    |   ['https://example.com', 'https://sub.example.com']
    | Use ['*'] to allow all origins.
    |
    */
    'allowed_origins' => [
        'https://yostracer.web.id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed origin patterns
    |--------------------------------------------------------------------------
    |
    | Using patterns, you can specify more flexible rules using wildcards:
    |   ['https://*.example.com']
    | If you don't need patterns, leave this empty.
    |
    */
    'allowed_origins_patterns' => [],

    /*
    |--------------------------------------------------------------------------
    | Allowed request headers
    |--------------------------------------------------------------------------
    |
    | Set the headers that are allowed in a cross-origin request. Use ['*']
    | to allow any header.
    |
    */
    'allowed_headers' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Exposed response headers
    |--------------------------------------------------------------------------
    |
    | These headers will be exposed to the browser. Use ['*'] to expose all.
    |
    */
    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | Max age (in seconds)
    |--------------------------------------------------------------------------
    |
    | This determines how long the results of a preflight request can be cached
    | by the client. A higher value reduces the number of preflight requests.
    |
    */
    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Supports credentials
    |--------------------------------------------------------------------------
    |
    | When true, the Access-Control-Allow-Credentials header is set to true,
    | allowing cookies and authentication headers to be sent in cross-origin requests.
    |
    */
    'supports_credentials' => false,

];
