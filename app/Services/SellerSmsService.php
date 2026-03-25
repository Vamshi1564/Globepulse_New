<?php
// FILE: app/Services/SellerSmsService.php
// FIXED:
//  1. SMS uses 10-digit number (smsgatewayhub requires no country code)
//  2. AiSensy uses 91XXXXXXXXXX format with country code
//  3. userName changed to "GFE" to match your AiSensy account name
//  4. b2botp campaign params match your existing template
//  5. SMS message matches DLT registered template exactly
//  6. Detailed logging so you can see exact errors in storage/logs/laravel.log

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SellerSmsService
{
    // ── SMS credentials (smsgatewayhub — same as GFE CRM) ────
    private const SMS_API_KEY   = 'kfRGNGqkU0qC6NnFrutXww';
    private const SMS_SENDER_ID = 'GFEWRD';
    private const SMS_DLT_ID    = '1207175696767224408';
    private const SMS_API_URL   = 'https://www.smsgatewayhub.com/api/mt/SendSMS';

    // ── AiSensy credentials ───────────────────────────────────
    private const AISENSY_URL          = 'https://backend.aisensy.com/campaign/t1/api/v2';
    private const AISENSY_OTP_CAMPAIGN = 'b2botp';  // your existing campaign
    private const AISENSY_USERNAME     = 'GFE';     // MUST match your AiSensy account userName

    // ─────────────────────────────────────────────────────────
    // OTP — send via SMS + WhatsApp
    // Called from SellerSignup::fireOtp()
    // ─────────────────────────────────────────────────────────
    public function sendOtpSms(string $phone, string $otp, string $name): void
    {
        Log::info("SellerSms: sendOtpSms called | phone={$phone} | otp={$otp} | name={$name}");

        $smsPhone      = $this->formatPhoneForSms($phone);      // 10 digits
        $whatsappPhone = $this->formatPhoneForWhatsApp($phone);  // 91XXXXXXXXXX

        Log::info("SellerSms: formatted | sms={$smsPhone} | wa={$whatsappPhone}");

        // ── SMS ───────────────────────────────────────────────
        if ($smsPhone) {
            // ⚠️ This message must EXACTLY match your DLT registered template
            // If it doesn't match, TRAI will block delivery
            // Current DLT template: "Dear User, Your OTP for login to GFE Smart CRM is {#var#}. Valid for 30 minutes. Please do not share this OTP. Regards, gfegroup Team."
            $msg = "Dear User, Your OTP for login to GFE Smart CRM is {$otp}. Valid for 30 minutes. Please do not share this OTP. Regards, gfegroup Team.";
            $this->sendSms($smsPhone, $msg);
        }

        // ── WhatsApp via AiSensy ──────────────────────────────
        // b2botp template has only 1 param: {{1}} = OTP
        // Confirmed working: params=["4321"] → HTTP 200
        if ($whatsappPhone) {
            $this->sendAiSensyWhatsApp(
                phone:        $whatsappPhone,
                campaignName: self::AISENSY_OTP_CAMPAIGN,
                params:       [$otp],  // ✅ Only OTP — confirmed working
            );
        }
    }

    // ─────────────────────────────────────────────────────────
    // Welcome — send via SMS + WhatsApp after OTP verified
    // Called from SellerVerifyOtp::verifyOtp()
    // ─────────────────────────────────────────────────────────
    public function sendWelcomeWhatsApp(string $phone, string $name, string $email, string $tempPassword): void
    {
        Log::info("SellerSms: sendWelcomeWhatsApp called | phone={$phone}");

        $smsPhone      = $this->formatPhoneForSms($phone);
        $whatsappPhone = $this->formatPhoneForWhatsApp($phone);

        $firstName  = ucfirst(strtolower(explode(' ', trim($name))[0]));
        $loginUrl   = url('/seller/login');
        $androidUrl = 'https://play.google.com/store/apps/details?id=crm.ani.com';

        // ── SMS ───────────────────────────────────────────────
        if ($smsPhone) {
            // Keep SMS short — DLT templates have character limits
            $msg = "Welcome to GlobPulse! Your account is verified. "
                 . "Email: {$email} | Password: {$tempPassword}. "
                 . "Login: {$loginUrl} "
                 . "- GlobPulse Team";
            $this->sendSms($smsPhone, $msg);
        }

        // ── WhatsApp ──────────────────────────────────────────
        // Only if you have created 'seller_welcome_credentials' campaign in AiSensy
        // If not created yet, comment this block out
        if ($whatsappPhone) {
            $this->sendAiSensyWhatsApp(
                phone:        $whatsappPhone,
                campaignName: 'seller_welcome_credentials',
                params:       [$firstName, $email, $tempPassword, $loginUrl],
            );
        }
    }

    // ─────────────────────────────────────────────────────────
    // Status update WhatsApp (approved/rejected/etc)
    // Called from SellerNotificationService
    // ─────────────────────────────────────────────────────────
    public function sendStatusWhatsApp(string $phone, string $status, string $firstName, string $businessName): void
    {
        $whatsappPhone = $this->formatPhoneForWhatsApp($phone);
        if (!$whatsappPhone) return;

        $templateMap = [
            'approved'     => ['seller_account_approved',  [$firstName, $businessName, url('/seller/dashboard')]],
            'rejected'     => ['seller_account_rejected',  [$firstName, $businessName, url('/seller/profile')]],
            'under_review' => ['seller_under_review',      [$firstName, $businessName]],
            'suspended'    => ['seller_account_suspended', [$firstName, $businessName]],
        ];

        if (!isset($templateMap[$status])) return;
        [$template, $params] = $templateMap[$status];

        $this->sendAiSensyWhatsApp(
            phone:        $whatsappPhone,
            campaignName: $template,
            params:       $params,
        );
    }

    // ─────────────────────────────────────────────────────────
    // PRIVATE: Send SMS via smsgatewayhub
    // Uses CURL exactly like existing GFE CRM code
    // ─────────────────────────────────────────────────────────
    private function sendSms(string $phone10digit, string $message): void
    {
        try {
            $encodedMsg = rawurlencode($message);

            $url = self::SMS_API_URL
                 . '?APIKey='        . self::SMS_API_KEY
                 . '&senderid='      . self::SMS_SENDER_ID
                 . '&channel=2'
                 . '&DCS=0'
                 . '&flashsms=0'
                 . '&number='        . $phone10digit
                 . '&text='          . $encodedMsg
                 . '&route=1'
                 . '&dlttemplateid=' . self::SMS_DLT_ID;

            Log::info("SellerSms: SMS URL = " . $url);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            $result = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                Log::error("SellerSms: SMS CURL error — {$curlError}");
            } else {
                Log::info("SellerSms: SMS response — " . $result);
            }

        } catch (\Exception $e) {
            Log::error("SellerSms: SMS exception — " . $e->getMessage());
        }
    }

    // ─────────────────────────────────────────────────────────
    // PRIVATE: AiSensy WhatsApp
    // ─────────────────────────────────────────────────────────
    private function sendAiSensyWhatsApp(
        string $phone,
        string $campaignName,
        array  $params,
    ): void {
        try {
            $apiKey = env('AISENSY_API_KEY');

            if (!$apiKey) {
                Log::error("SellerSms: AISENSY_API_KEY missing in .env");
                return;
            }

            $payload = [
                'apiKey'         => $apiKey,
                'campaignName'   => $campaignName,
                'destination'    => $phone,
                'userName'       => self::AISENSY_USERNAME, // "GFE" — must match AiSensy account
                'templateParams' => $params,
                'source'         => 'new-landing-page form',
                'media'          => [],
                'buttons'        => [],
                'carouselCards'  => [],
                'location'       => [],
            ];

            Log::info("SellerSms: AiSensy payload = " . json_encode($payload));

            $response = Http::timeout(15)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post(self::AISENSY_URL, $payload);

            Log::info("SellerSms: AiSensy response [{$campaignName}] status={$response->status()} body=" . $response->body());

            if (!$response->successful()) {
                Log::warning("SellerSms: AiSensy FAILED [{$campaignName}] to {$phone} — " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("SellerSms: AiSensy exception — " . $e->getMessage());
        }
    }

    // ─────────────────────────────────────────────────────────
    // Phone formatters — two separate methods, different formats
    // ─────────────────────────────────────────────────────────

    // smsgatewayhub needs 10-digit Indian number WITHOUT country code
    private function formatPhoneForSms(?string $phone): ?string
    {
        if (!$phone) return null;
        $digits = preg_replace('/\D/', '', $phone);

        // Strip 91 prefix if present → get 10 digits
        if (strlen($digits) === 12 && str_starts_with($digits, '91')) {
            $digits = substr($digits, 2);
        }
        if (strlen($digits) === 11 && str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        // Must be exactly 10 digits for Indian numbers
        if (strlen($digits) === 10) {
            return $digits;
        }

        Log::warning("SellerSms: Invalid phone for SMS — original={$phone} digits={$digits}");
        return null;
    }

    // AiSensy WhatsApp needs 91XXXXXXXXXX (12 digits with country code)
    private function formatPhoneForWhatsApp(?string $phone): ?string
    {
        if (!$phone) return null;
        $digits = preg_replace('/\D/', '', $phone);

        // Already 12 digits with 91 prefix
        if (strlen($digits) === 12 && str_starts_with($digits, '91')) {
            return $digits;
        }
        // 10-digit Indian number → add 91
        if (strlen($digits) === 10) {
            return '91' . $digits;
        }
        // 11 digits starting with 0 → replace 0 with 91
        if (strlen($digits) === 11 && str_starts_with($digits, '0')) {
            return '91' . substr($digits, 1);
        }
        // Other country — use as-is (international sellers)
        if (strlen($digits) >= 10) {
            return $digits;
        }

        Log::warning("SellerSms: Invalid phone for WhatsApp — original={$phone} digits={$digits}");
        return null;
    }
}