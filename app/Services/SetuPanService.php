<?php
// FILE: app/Services/SetuPanService.php
  
// namespace App\Services;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;

// class SetuPanService
// {
//     private string $baseUrl;
//     private string $clientId;
//     private string $clientSecret;
//     private string $instanceId;

//     public function __construct()
//     {
//         $this->baseUrl      = config('services.setu.sandbox', true)
//             ? 'https://dg-sandbox.setu.co'
//             : 'https://dg.setu.co';

//         $this->clientId     = config('services.setu.client_id')              ?: env('SETU_CLIENT_ID', '');
//         $this->clientSecret = config('services.setu.client_secret')           ?: env('SETU_CLIENT_SECRET', '');
//         $this->instanceId   = config('services.setu.pan_product_instance_id') ?: env('SETU_PAN_PRODUCT_INSTANCE_ID', '');
//     }

//     public function verify(string $pan): array
//     {
//         $pan = strtoupper(trim($pan));

//         if (empty($this->clientId) || empty($this->clientSecret) || empty($this->instanceId)) {
//             Log::error('SetuPanService: missing credentials', [
//                 'client_id_set'   => !empty($this->clientId),
//                 'secret_set'      => !empty($this->clientSecret),
//                 'instance_id_set' => !empty($this->instanceId),
//             ]);
//             return [
//                 'success' => false,
//                 'message' => 'PAN service not configured. Check SETU_PAN_PRODUCT_INSTANCE_ID in .env',
//                 'data'    => [],
//             ];
//         }

//         Log::info('Setu PAN verify', ['pan' => $pan, 'sandbox' => config('services.setu.sandbox', true)]);

//         try {
//             $response = Http::withHeaders([
//                 'x-client-id'           => $this->clientId,
//                 'x-client-secret'       => $this->clientSecret,
//                 'x-product-instance-id' => $this->instanceId,
//                 'Content-Type'          => 'application/json',
//             ])->timeout(15)->post("{$this->baseUrl}/api/verify/pan", [
//                 'pan'     => $pan,
//                 'consent' => 'Y',
//                 'reason'  => 'KYC verification for B2B seller onboarding',
//             ]);

//             $body         = $response->json();
//             $verification = strtolower($body['verification'] ?? '');

//             Log::info('Setu PAN response', ['http' => $response->status(), 'verification' => $verification]);

//             if ($response->ok() && $verification === 'success') {
//                 $data = $body['data'] ?? [];
//                 return [
//                     'success' => true,
//                     'message' => 'PAN verified successfully.',
//                     'data'    => [
//                         'full_name'              => $data['name']                 ?? $data['full_name']              ?? '',
//                         'category'               => $data['type']                 ?? $data['category']               ?? 'Individual',
//                         'pan_status'             => $data['panStatus']            ?? $data['pan_status']             ?? 'VALID',
//                         'aadhaar_seeding_status' => $data['aadhaarSeedingStatus'] ?? $data['aadhaar_seeding_status']  ?? '',
//                     ],
//                 ];
//             }

//             $msg = match($response->status()) {
//                 404 => 'PAN not found. Use ABCDE1234A for sandbox testing.',
//                 401 => 'Authentication failed. Check Setu credentials in .env',
//                 422 => $body['message'] ?? 'Invalid request. Check PAN format.',
//                 default => $body['error']['detail'] ?? $body['message'] ?? 'PAN verification failed (HTTP '.$response->status().')',
//             };

//             return ['success' => false, 'message' => $msg, 'data' => []];

//         } catch (\Exception $e) {
//             Log::error('Setu PAN exception', ['error' => $e->getMessage()]);
//             return ['success' => false, 'message' => 'Connection error: ' . $e->getMessage(), 'data' => []];
//         }
//     }
// }  

// FILE: app/Services/SetuPanService.php


// FILE: app/Services/SetuPanService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
 

class SetuPanService
{
    private string $baseUrl;
    private string $clientId;
    private string $clientSecret;
    private string $instanceId;
 
    public function __construct()
    {
        // Use dedicated config/setu.php — more reliable on deployed servers
        // Falls back to direct env() if config cache is missing the key
        $this->baseUrl      = config('setu.base_url')      ?: (env('SETU_SANDBOX', true) ? 'https://dg-sandbox.setu.co' : 'https://dg.setu.co');
        $this->clientId     = config('setu.client_id')      ?: env('SETU_CLIENT_ID', '');
        $this->clientSecret = config('setu.client_secret')  ?: env('SETU_CLIENT_SECRET', '');
        $this->instanceId   = config('setu.pan_instance_id') ?: env('SETU_PAN_PRODUCT_INSTANCE_ID', '');
    }

    public function verify(string $pan): array
    {
        $pan = strtoupper(trim($pan));

        if (empty($this->clientId) || empty($this->clientSecret) || empty($this->instanceId)) {
            Log::error('SetuPanService: missing credentials', [
                'client_id_set'   => !empty($this->clientId),
                'secret_set'      => !empty($this->clientSecret),
                'instance_id_set' => !empty($this->instanceId),
                'config_setu_pan' => config('setu.pan_instance_id') ? 'SET' : 'EMPTY',
                'env_pan'         => env('SETU_PAN_PRODUCT_INSTANCE_ID') ? 'SET' : 'EMPTY',
            ]);
            return [
                'success' => false,
                'message' => 'PAN service not configured. Check SETU_PAN_PRODUCT_INSTANCE_ID in .env and run: php artisan config:clear',
                'data'    => [],
            ];
        }

        Log::info('Setu PAN verify', [
            'pan'      => $pan,
            'base_url' => $this->baseUrl,
            'instance' => substr($this->instanceId, 0, 8) . '...',
        ]);

        try {
            $response = Http::withHeaders([
                'x-client-id'           => $this->clientId,
                'x-client-secret'       => $this->clientSecret,
                'x-product-instance-id' => $this->instanceId,
                'Content-Type'          => 'application/json',
            ])->timeout(15)->post("{$this->baseUrl}/api/verify/pan", [
                'pan'     => $pan,
                'consent' => 'Y',
                'reason'  => 'KYC verification for B2B seller onboarding',
            ]);

            $body         = $response->json();
            $verification = strtolower($body['verification'] ?? '');

            Log::info('Setu PAN response', [
                'http_status'  => $response->status(),
                'verification' => $verification,
                'body'         => $body,
            ]);

            if ($response->ok() && $verification === 'success') {
                $data = $body['data'] ?? [];
                return [
                    'success' => true,
                    'message' => 'PAN verified successfully.',
                    'data'    => [
                        'full_name'              => $data['name']                  ?? $data['full_name']             ?? '',
                        'category'               => $data['type']                  ?? $data['category']              ?? 'Individual',
                        'pan_status'             => $data['panStatus']             ?? $data['pan_status']            ?? 'VALID',
                        'aadhaar_seeding_status' => $data['aadhaarSeedingStatus']  ?? $data['aadhaar_seeding_status'] ?? '',
                    ],
                ];
            }

            $errorMsg = match((int) $response->status()) {
                401, 403 => 'Invalid Setu credentials. Check CLIENT_ID and CLIENT_SECRET in .env — also check that SETU_PAN_PRODUCT_INSTANCE_ID matches this client in Setu dashboard.',
                404      => 'PAN not found. Sandbox test PAN: ABCDE1234A',
                422      => $body['message'] ?? 'Invalid request format.',
                default  => $body['error']['detail'] ?? $body['message'] ?? 'PAN verification failed (HTTP ' . $response->status() . ')',
            };

            return ['success' => false, 'message' => $errorMsg, 'data' => []];

        } catch (\Exception $e) {
            Log::error('Setu PAN exception', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Connection error: ' . $e->getMessage(), 'data' => []];
        }
    }
}