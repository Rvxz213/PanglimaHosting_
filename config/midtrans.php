<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Midtrans payment gateway.
    | You can get these values from your Midtrans dashboard.
    |
    */

    'merchant_id' => env('MIDTRANS_MERCHANT_ID', ''),
    
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),
    
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    
    /*
    |--------------------------------------------------------------------------
    | Default Payment Methods
    |--------------------------------------------------------------------------
    |
    | Configure which payment methods are enabled by default.
    |
    */
    
    'enabled_payments' => [
        'credit_card',
        'bca_va',
        'bni_va', 
        'bri_va',
        'mandiri_clickpay',
        'gopay',
        'indomaret',
        'danamon_online',
        'akulaku',
        'shopeepay',
        'kredivo',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Callback URLs
    |--------------------------------------------------------------------------
    |
    | URLs for payment callbacks and redirects.
    |
    */
    
    'callback_url' => env('MIDTRANS_CALLBACK_URL', ''),
    
    'finish_redirect_url' => env('MIDTRANS_FINISH_REDIRECT_URL', ''),
    
    'error_redirect_url' => env('MIDTRANS_ERROR_REDIRECT_URL', ''),
    
    'pending_redirect_url' => env('MIDTRANS_PENDING_REDIRECT_URL', ''),
]; 