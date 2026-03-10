<?php

namespace App;

// use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

trait NotificationWpSmsTrait
{



    // function sendNotification($deviceToken, $title, $description)
    // {


    //     $url = "https://fcm.googleapis.com/v1/projects/gfe-bizapp/messages:send";
    //     $client = new Client();

    //     $accessToken = DB::table('tbl_keys')
    //         ->where('key_name', 'GoogleAccessToken')
    //         ->value('key_description');

    //     $notification = [
    //         'message' => [
    //             'token' => $deviceToken,
    //             'notification' => [
    //                 'title' => $title,
    //                 'body' => $description,
    //             ],
    //             "data" => [
    //                 "type" => "notification"
    //             ]
    //         ],
    //     ];

    //     try {
    //         $response = $client->post($url, [
    //             'headers' => [
    //                 'Authorization' => "Bearer $accessToken",
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => $notification,
    //         ]);
    //         echo 'Notification sent: ' . $response->getBody();
    //     } catch (\Exception $e) {
    //         echo 'Error: ' . $e->getMessage();
    //         if ($e instanceof \GuzzleHttp\Exception\ClientException) {
    //             echo 'Response: ' . $e->getResponse()->getBody();
    //         }
    //     }
    // }

    // use Illuminate\Support\Facades\DB;
    // use Illuminate\Support\Facades\Log;
    // use GuzzleHttp\Client;

    function sendNotification($deviceToken, $title, $description)
    {
        $url = "https://fcm.googleapis.com/v1/projects/gfe-bizapp/messages:send";
        $client = new Client();

        $accessToken = DB::table('tbl_keys')
            ->where('key_name', 'GoogleAccessToken')
            ->value('key_description');

        $notification = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body'  => $description,
                ],
                "data" => [
                    "type" => "notification"
                ]
            ],
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Content-Type'  => 'application/json',
                ],
                'json' => $notification,
            ]);

            // Store in log instead of echo
            // Log::info('FCM Notification sent', [
            //     'title'   => $title,
            //     'body'    => $description,
            //     'device'  => $deviceToken,
            //     'response' => $response->getBody()->getContents(),
            // ]);

            return true;
        } catch (\Exception $e) {
            // Log::error('FCM Notification Error', [
            //     'message' => $e->getMessage(),
            //     'device'  => $deviceToken,
            // ]);

            // if ($e instanceof \GuzzleHttp\Exception\ClientException) {
            //     Log::error('FCM Response', [
            //         'response' => $e->getResponse()->getBody()->getContents(),
            //     ]);
            // }

            return false;
        }
    }



    public function sendSms($phone, $clientName , $taskName, $statusName)
    {
        // $otp       = rand(1111, 9999);
        $apikey    = "kfRGNGqkU0qC6NnFrutXww";
        $apisender = "GFEWRD";
        $msg = "Dear {$clientName}, thank you for choosing our services. Please check your account details here: https://gfego.in/GFEWRD/ Service Status:({$taskName}) {$statusName} - GFE Support Team";
        // $msg       = $msg;
        $url       = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=' . $apikey . '&senderid=' . $apisender . '&channel=2&DCS=0&flashsms=0&number=' . $phone . '&text=' . rawurlencode($msg) . '&route=1&&dlttemplateid=1207175697762959477';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
        $response = curl_exec($ch);
        curl_close($ch);

        // return $otp;
        return $response;
    }

    // public function sendWhatsapp($phone, $name)
    // {
    //     $endpoint = 'https://backend.aisensy.com/campaign/t1/api/v2';
    //     $templateParams = [$name, "GST", "Done", "https://gfego.in/apps"];

    //     $payload = [
    //         "apiKey"        => "your_api_key_here",
    //         "campaignName"  => "OPSTASK",
    //         "destination"   => $phone,
    //         "userName"      => "GFE",
    //         "templateParams" => $templateParams
    //     ];

    //     $ch = curl_init($endpoint);
    //     curl_setopt_array($ch, [
    //         CURLOPT_POST           => true,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    //         CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    //     ]);

    //     $response = curl_exec($ch);
    //     curl_close($ch);

    //     return $response;
    // }
    public function sendWhatsapp($phone, $name, $taskName, $status)
    {
        $endpoint = 'https://backend.aisensy.com/campaign/t1/api/v2';
        $templateParams = [$name, $taskName, $status, "https://gfego.in/apps"];

        $payload = [
            "apiKey"         => config('services.aisensy.key'), // <-- move API key to config/services.php
            "campaignName"   => "OPSTASK",
            "destination"    => $phone,
            "userName"       => "GFE",
            "templateParams" => $templateParams
        ];

        try {
            $client = new Client();
            $response = $client->post($endpoint, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            // optional logging
            // Log::info("WhatsApp sent", ['phone' => $phone, 'name' => $name, 'result' => $result]);

            return $result; // return decoded response array

        } catch (\Exception $e) {
            // Log::error("WhatsApp Error", ['phone' => $phone, 'error' => $e->getMessage()]);
            return false;
        }
    }
}
