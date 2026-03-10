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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    // config/services.php
    'aisensy' => [
        'key' => env('AISENSY_API_KEY'),
    ],

    //google captcha configuration
    'recaptcha' => [
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret'   => env('RECAPTCHA_SECRET_KEY'),
    ],

    'whatsapp' => [
        'url' => env('WHATSAPP_API_URL'),
        'status_url' => env('WHATSAPP_STATUS_URL'),
        'key' => env('WHATSAPP_API_KEY'),
    ],

    'email_api' => [
        'url' => env('EMAIL_API_URL'),
        'key' => env('EMAIL_API_KEY'),
        'from_name' => env('EMAIL_FROM_NAME'),
        'from_address' => env('EMAIL_FROM_ADDRESS'),
    ],

];
