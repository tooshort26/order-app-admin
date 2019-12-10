<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary API configuration
    |--------------------------------------------------------------------------
    |
    | Before using Cloudinary you need to register and get some detail
    | to fill in below, please visit cloudinary.com.
    |
    */

    'cloudName'  => "dpcxcsdiw",
    'baseUrl'    => env('CLOUDINARY_BASE_URL', 'http://res.cloudinary.com/'."dpcxcsdiw"),
    'secureUrl'  => env('CLOUDINARY_SECURE_URL', 'https://res.cloudinary.com/'."dpcxcsdiw"),
    'apiBaseUrl' => env('CLOUDINARY_API_BASE_URL', 'https://api.cloudinary.com/v1_1/'."dpcxcsdiw"),
    'apiKey'     => "656376291681576",
    'apiSecret'  => "DKNutTDQKz8KeriiiP9kTujTOCU",

    'scaling'    => [
        'format' => 'png',
        'width'  => 150,
        'height' => 150,
        'crop'   => 'fit',
        'effect' => null
    ],

];
