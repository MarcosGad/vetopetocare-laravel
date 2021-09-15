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
    
    'facebook' => [
    'client_id' => '3291738210904137',
    'client_secret' => 'f7df6e639fdecdd284fa12c66af73d9a',
    'redirect' => 'https://vetopetocare.com/callback/facebook',
    ],
    
    'google' => [
        'client_id' => '18498667182-2ltbs9e1u5eseinmq0i93rrsm3ubjeg2.apps.googleusercontent.com',
        'client_secret' => 'J6hckuLa9P982OrY-Xxes2wC',
        'redirect' => 'https://vetopetocare.com/auth/google/callback',
    ],

];
