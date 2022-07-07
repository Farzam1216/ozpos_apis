<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
      'client_id' => '597747473688-ucmp1mka3i7aqfcu7gf0212ta1nhc4od.apps.googleusercontent.com',
      'client_secret' => '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',
      'redirect' => 'http://192.168.18.27:8000/auth/google/callback',
    ],

    'facebook' => [
      'client_id' => '2631526777129043',
      'client_secret' => '2640483e44113c528f8e589f73014800',
      'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

];
