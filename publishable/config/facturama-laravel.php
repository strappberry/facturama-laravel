<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Sandbox
     |--------------------------------------------------------------------------
     |
     | Especifica si se utilizará el endpoint del Sandbox
     |
     */
    'sandbox' => env('FACTURAMA_SANDBOX', true),


    /*
     |--------------------------------------------------------------------------
     | Api Endpoints
     |--------------------------------------------------------------------------
     |
     | Endpoints para la Api de producción y de sandbox
     |
     */
    'api_endpoints' => [
        'production' => env('FACTURAMA_PRODUCTION_ENDPOINT', 'https://api.facturama.mx'),
        'sandbox'    => env('FACTURAMA_SANDBOX_ENDPOINT', 'https://apisandbox.facturama.mx'),
    ],

    /*
     |--------------------------------------------------------------------------
     | User
     |--------------------------------------------------------------------------
     |
     | Credenciales para autenticarse con la Api
     | Por default se utiliza el usuario de pruebas
     |
     */
    'user' => [
        'username' => env('FACTURAMA_USERNAME', 'pruebas'),
        'password' => env('FACTURAMA_PASSWORD', 'pruebas2011'),
    ]
];
