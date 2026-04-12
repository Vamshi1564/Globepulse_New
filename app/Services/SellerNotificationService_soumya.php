<?php
// FILE: app/Services/SellerNotificationService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SellerStatusMail;

class SellerNotificationService
{
    private const AISENSY_URL          = 'https://backend.aisensy.com/campaign/t1/api/v2';
    private const TEMPLATE_APPROVED    = 'seller_account_approved';
    private const TEMPLATE_REJECTED    = 'seller_account_rejected';
    private const TEMPLATE_REVIEW      = 'seller_under_review';
    private const TEMPLATE_SUSPENDED   = 'seller_account_suspended';

    public function notify(object $seller, string $newStatus): void
    {
        $notifyOn = ['approved', 'rejected', 'under_review', 'suspended'];
        if (!in_array($newStatus, $notifyOn)) return;

        $businessName = $seller->legal_business_name ?? 'your business';
        $firstName    = $this->extractFirstName($businessName);

        // WhatsApp notification via AiSensy
        $this->sendWhatsApp($seller, $newStatus, $firstName, $businessName);

        $this->sendEmail($seller, $newStatus, $firstName, $businessName);
    }

    // ─────────────────────────────────────────────────────────
    // Email — explicitly set SMTP config to avoid .env issues
    // ─────────────────────────────────────────────────────────
    private function sendEmail(object $seller, string $status, string $firstName, string $businessName): void
    {
        try {
            // Force correct mailer config at runtime — avoids cached/wrong config issues
            config([
                'mail.default'                      => 'smtp',
                'mail.mailers.smtp.host'            => env('MAIL_HOST', 'smtp.hostinger.com'),
                'mail.mailers.smtp.port'            => (int) env('MAIL_PORT', 465),
                'mail.mailers.smtp.encryption'      => env('MAIL_ENCRYPTION', 'ssl'),
                'mail.mailers.smtp.username'        => env('MAIL_USERNAME'),
                'mail.mailers.smtp.password'        => env('MAIL_PASSWORD'),
                'mail.mailers.smtp.timeout'         => 30,
                'mail.mailers.smtp.verify_peer'     => false, // fixes SSL cert issues on localhost
                'mail.from.address'                 => env('MAIL_FROM_ADDRESS', 'no-reply@globpulse.com'),
                'mail.from.name'                    => 'GlobPulse',  // hardcoded — avoids ${APP_NAME} issue
            ]);

            Mail::mailer('smtp')
                ->to($seller->email)
                ->send(new SellerStatusMail($seller, $status, $firstName, $businessName));

            Log::info("SellerNotification: ✅ Email sent to {$seller->email} | status={$status}");

        } catch (\Symfony\Component\Mailer\Exception\TransportException $e) {
            Log::error("SellerNotification: ❌ SMTP Transport error — " . $e->getMessage());
        } catch (\Exception $e) {
            Log::error("SellerNotification: ❌ Email failed — " . get_class($e) . ': ' . $e->getMessage());
        }
    }

    // ─────────────────────────────────────────────────────────
    // WhatsApp via AiSensy (disabled until templates ready)
    // ─────────────────────────────────────────────────────────
    private function sendWhatsApp(object $seller, string $status, string $firstName, string $businessName): void
    {
        try {
            $phone = $this->formatPhone($seller->phone);
            if (!$phone) {
                Log::warning("SellerNotification: No valid phone for seller {$seller->id}");
                return;
            }

            $payload = $this->buildWhatsAppPayload($phone, $status, $firstName, $businessName);
            if (!$payload) return;

            $response = Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post(self::AISENSY_URL, $payload);

            if ($response->successful()) {
                Log::info("SellerNotification: ✅ WhatsApp sent to {$phone} | status={$status}");
            } else {
                Log::error("SellerNotification: ❌ WhatsApp failed | {$response->status()} | " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("SellerNotification: ❌ WhatsApp exception — " . $e->getMessage());
        }
    }

    private function buildWhatsAppPayload(string $phone, string $status, string $firstName, string $businessName): ?array
    {
        $apiKey = config('services.aisensy.api_key');

        $templateMap = [
            'approved'     => [self::TEMPLATE_APPROVED,  [$firstName, $businessName, config('app.url') . '/seller/dashboard']],
            'rejected'     => [self::TEMPLATE_REJECTED,  [$firstName, $businessName, config('app.url') . '/seller/profile']],
            'under_review' => [self::TEMPLATE_REVIEW,    [$firstName, $businessName]],
            'suspended'    => [self::TEMPLATE_SUSPENDED, [$firstName, $businessName]],
        ];

        if (!isset($templateMap[$status])) return null;

        [$templateName, $params] = $templateMap[$status];

        return [
            'apiKey'         => $apiKey,
            'campaignName'   => $templateName,
            'destination'    => $phone,
            'userName'       => 'GlobPulse',
            'templateParams' => $params,
            'source'         => 'admin-panel',
            'media'          => [],
            'buttons'        => [],
            'carouselCards'  => [],
            'location'       => [],
        ];
    }

    private function formatPhone(?string $phone): ?string
    {
        if (!$phone) return null;
        $digits = preg_replace('/\D/', '', $phone);
        if (strlen($digits) === 12 && str_starts_with($digits, '91')) return $digits;
        if (strlen($digits) === 10) return '91' . $digits;
        if (strlen($digits) >= 11) return $digits;
        return null;
    }

    private function extractFirstName(string $businessName): string
    {
        return ucfirst(strtolower(explode(' ', trim($businessName))[0]));
    }
}