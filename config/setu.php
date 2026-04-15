<?php
// FILE: config/setu.php
// ─────────────────────────────────────────────────────────────────────
// IMPORTANT: After adding this file run:
//   php artisan config:clear
//   php artisan cache:clear
// ─────────────────────────────────────────────────────────────────────
// This is a DEDICATED config file for Setu — more reliable than
// putting it inside services.php, especially on deployed servers.
// ─────────────────────────────────────────────────────────────────────
 
return [

    /*
    |──────────────────────────────────────────────────────────────────
    | Sandbox mode
    | Set SETU_SANDBOX=true in .env for testing, false for production
    |──────────────────────────────────────────────────────────────────
    */
    'sandbox' => env('SETU_SANDBOX', true),

    /*
    |──────────────────────────────────────────────────────────────────
    | Base URLs
    |──────────────────────────────────────────────────────────────────
    */
    'base_url' => env('SETU_SANDBOX', true)
        ? 'https://dg-sandbox.setu.co'
        : 'https://dg.setu.co',

    /*
    |──────────────────────────────────────────────────────────────────
    | Shared credentials (same for all products)
    |──────────────────────────────────────────────────────────────────
    */
    'client_id'     => env('SETU_CLIENT_ID', ''),
    'client_secret' => env('SETU_CLIENT_SECRET', ''),

    /*
    |──────────────────────────────────────────────────────────────────
    | Product Instance IDs
    | Each product in Setu dashboard gets its own instance ID.
    | These are found under: Setu Dashboard > Products > [Product] > Settings
    |──────────────────────────────────────────────────────────────────
    */
    'pan_instance_id'        => env('SETU_PAN_PRODUCT_INSTANCE_ID', ''),
    'gst_instance_id'        => env('SETU_GST_PRODUCT_INSTANCE_ID', ''),
    'digilocker_instance_id' => env('SETU_DIGILOCKER_PRODUCT_INSTANCE_ID', ''),

]; 