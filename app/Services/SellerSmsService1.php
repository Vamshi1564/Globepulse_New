<?php
// FILE: app/Services/SellerSmsService.php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SellerSmsService
{
    // ── SMS credentials ───────────────────────────────────────
    private const SMS_API_KEY          = 'kfRGNGqkU0qC6NnFrutXww';
    private const SMS_SENDER_ID        = 'GFEWRD';
    private const SMS_DLT_ID           = '1207175696767224408';
    private const SMS_API_URL          = 'https://www.smsgatewayhub.com/api/mt/SendSMS';

    // ── AiSensy credentials ───────────────────────────────────
    private const AISENSY_URL          = 'https://backend.aisensy.com/campaign/t1/api/v2';
    private const AISENSY_OTP_CAMPAIGN = 'globpulse_otp'; // confirmed working
    private const AISENSY_USERNAME     = 'gfe';           // lowercase — confirmed working

    // ─────────────────────────────────────────────────────────
    // OTP — SMS + WhatsApp
    // $countryId = tblcountries.country_id integer e.g. 101 for India
    // ─────────────────────────────────────────────────────────
    public function sendOtpSms(string $phone, string $otp, string $name, mixed $countryId = null): void
    {
        $callingCode   = $this->getCallingCode($countryId);
        $smsPhone      = $this->formatPhoneForSms($phone, $callingCode);
        $whatsappPhone = $this->formatPhoneForWhatsApp($phone, $callingCode);

        Log::info("SellerSms: OTP | phone={$phone} | sms={$smsPhone} | wa={$whatsappPhone} | cc=+{$callingCode}");

        // ── SMS — always reliable, no opt-in needed ───────────
        if ($smsPhone) {
            $msg = "Dear User, Your OTP for login to GFE Smart CRM is {$otp}. Valid for 30 minutes. Please do not share this OTP. Regards, gfegroup Team.";
            $this->sendSms($smsPhone, $msg);
        }

        // ── WhatsApp — best effort ────────────────────────────
        if ($whatsappPhone) {
            $this->sendAiSensyWhatsApp(
                phone:        $whatsappPhone,
                campaignName: self::AISENSY_OTP_CAMPAIGN,
                params:       [$otp],
            );
        }
    }

    // ─────────────────────────────────────────────────────────
    // Welcome — after OTP verified
    // ─────────────────────────────────────────────────────────
    public function sendWelcomeWhatsApp(string $phone, string $name, string $email, string $tempPassword, mixed $countryId = null): void
    {
        $callingCode   = $this->getCallingCode($countryId);
        $smsPhone      = $this->formatPhoneForSms($phone, $callingCode);
        $whatsappPhone = $this->formatPhoneForWhatsApp($phone, $callingCode);

        $firstName = ucfirst(strtolower(explode(' ', trim($name))[0]));
        $loginUrl  = url('/seller/login');

        if ($smsPhone) {
            $msg = "Welcome to GlobPulse! Your account is verified. "
                 . "Email: {$email} | Password: {$tempPassword}. "
                 . "Login: {$loginUrl} - GlobPulse Team";
            $this->sendSms($smsPhone, $msg);
        }

        if ($whatsappPhone) {
            try {
                $this->sendAiSensyWhatsApp(
                    phone:        $whatsappPhone,
                    campaignName: 'seller_welcome_credentials',
                    params:       [$firstName, $email, $tempPassword, $loginUrl],
                );
            } catch (\Exception $e) {
                Log::info("SellerSms: Welcome WA skipped — " . $e->getMessage());
            }
        }
    }

    // ─────────────────────────────────────────────────────────
    // Status update WhatsApp
    // ─────────────────────────────────────────────────────────
    public function sendStatusWhatsApp(string $phone, string $status, string $firstName, string $businessName, mixed $countryId = null): void
    {
        $callingCode   = $this->getCallingCode($countryId);
        $whatsappPhone = $this->formatPhoneForWhatsApp($phone, $callingCode);
        if (!$whatsappPhone) return;

        $templateMap = [
            'approved'     => ['seller_account_approved',  [$firstName, $businessName, url('/seller/dashboard')]],
            'rejected'     => ['seller_account_rejected',  [$firstName, $businessName, url('/seller/profile')]],
            'under_review' => ['seller_under_review',      [$firstName, $businessName]],
            'suspended'    => ['seller_account_suspended', [$firstName, $businessName]],
        ];

        if (!isset($templateMap[$status])) return;
        [$template, $params] = $templateMap[$status];

        $this->sendAiSensyWhatsApp(phone: $whatsappPhone, campaignName: $template, params: $params);
    }

    // ─────────────────────────────────────────────────────────
    // Get calling code from tblcountries
    // $countryId = tblcountries.country_id integer (e.g. 101 for India)
    // ─────────────────────────────────────────────────────────
    private function getCallingCode(mixed $countryId): string
    {
        if (!$countryId) return '91';

        try {
            // Primary: lookup by country_id integer
            $row = DB::table('tblcountries')
                ->where('country_id', $countryId)
                ->first();

            // Fallback: lookup by iso2 e.g. 'IN'
            if (!$row && strlen((string)$countryId) === 2) {
                $row = DB::table('tblcountries')
                    ->whereRaw('LOWER(iso2) = ?', [strtolower((string)$countryId)])
                    ->first();
            }

            // Fallback: lookup by short_name e.g. 'India'
            if (!$row) {
                $row = DB::table('tblcountries')
                    ->whereRaw('LOWER(short_name) = ?', [strtolower((string)$countryId)])
                    ->first();
            }

            if ($row && !empty($row->calling_code)) {
                $clean = preg_replace('/[^0-9]/', '',
                    explode(',', $row->calling_code)[0]
                ) ?: '91';
                Log::info("SellerSms: calling_code({$countryId}) → +{$clean} ({$row->short_name})");
                return $clean;
            }

        } catch (\Exception $e) {
            Log::warning("SellerSms: getCallingCode({$countryId}) error — " . $e->getMessage());
        }

        return '91';
    }

    // ─────────────────────────────────────────────────────────
    // SMS — smsgatewayhub needs 10-digit number (no country code)
    // ─────────────────────────────────────────────────────────
    private function formatPhoneForSms(?string $phone, string $callingCode = '91'): ?string
    {
        if (!$phone) return null;
        $digits = preg_replace('/\D/', '', $phone);

        // Strip country code if present
        if (str_starts_with($digits, $callingCode) && strlen($digits) > strlen($callingCode) + 6) {
            $digits = substr($digits, strlen($callingCode));
        }

        // Strip leading 0
        if (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        return strlen($digits) >= 7 ? $digits : null;
    }

    // ─────────────────────────────────────────────────────────
    // WhatsApp — AiSensy needs full international format
    // India: 919876543210 | USA: 12125551234 | UK: 447911123456
    // ─────────────────────────────────────────────────────────
    private function formatPhoneForWhatsApp(?string $phone, string $callingCode = '91'): ?string
    {
        if (!$phone) return null;
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        // Already has country code
        if (str_starts_with($digits, $callingCode) && strlen($digits) > strlen($callingCode) + 6) {
            return $digits;
        }

        return strlen($digits) >= 7 ? $callingCode . $digits : null;
    }

    // ─────────────────────────────────────────────────────────
    // Send SMS via smsgatewayhub (same CURL as GFE CRM)
    // ─────────────────────────────────────────────────────────
    private function sendSms(string $phone, string $message): void
    {
        try {
            $url = self::SMS_API_URL
                 . '?APIKey='        . self::SMS_API_KEY
                 . '&senderid='      . self::SMS_SENDER_ID
                 . '&channel=2&DCS=0&flashsms=0'
                 . '&number='        . $phone
                 . '&text='          . rawurlencode($message)
                 . '&route=1'
                 . '&dlttemplateid=' . self::SMS_DLT_ID;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            $result    = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            $curlError
                ? Log::error("SellerSms: SMS CURL error — {$curlError}")
                : Log::info("SellerSms: SMS response — {$result}");

        } catch (\Exception $e) {
            Log::error("SellerSms: SMS exception — " . $e->getMessage());
        }
    }

    // ─────────────────────────────────────────────────────────
    // Send WhatsApp via AiSensy (exact working CURL payload)
    // ─────────────────────────────────────────────────────────
    private function sendAiSensyWhatsApp(string $phone, string $campaignName, array $params): void
    {
        try {
            $apiKey = env('AISENSY_API_KEY');
            if (!$apiKey) {
                Log::error("SellerSms: AISENSY_API_KEY missing in .env");
                return;
            }

            $isOtp = $campaignName === self::AISENSY_OTP_CAMPAIGN;
            $otp   = $params[0] ?? '';

            $payload = [
                'apiKey'              => $apiKey,
                'campaignName'        => $campaignName,
                'destination'         => $phone,
                'userName'            => self::AISENSY_USERNAME,
                'templateParams'      => $params,
                'source'              => 'new-landing-page form',
                'media'               => (object)[],
                'carouselCards'       => [],
                'location'            => (object)[],
                'attributes'          => (object)[],
                'paramsFallbackValue' => ['FirstName' => 'user'],
                'buttons'             => $isOtp && $otp ? [[
                    'type'       => 'button',
                    'sub_type'   => 'url',
                    'index'      => 0,
                    'parameters' => [['type' => 'text', 'text' => $otp]],
                ]] : [],
            ];

            $ch = curl_init(self::AISENSY_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response  = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                Log::error("SellerSms: AiSensy CURL error — {$curlError}");
                return;
            }

            $decoded = json_decode($response, true);
            !empty($decoded['success'])
                ? Log::info("SellerSms: ✅ WA sent [{$campaignName}] to {$phone}")
                : Log::warning("SellerSms: ❌ WA failed [{$campaignName}] → {$response}");

        } catch (\Exception $e) {
            Log::error("SellerSms: AiSensy exception — " . $e->getMessage());
        }
    }
}