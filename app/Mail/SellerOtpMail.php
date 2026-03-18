<?php
// FILE: app/Mail/SellerOtpMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $otp,
        public string $sellerName,
        public string $sellerEmail
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔐 ' . $this->otp . ' — Your GlobPulse Verification Code',
        );
    }

    public function content(): Content
    {
        return new Content(htmlString: $this->buildHtml());
    }

    private function buildHtml(): string
    {
        $year  = date('Y');
        $name  = htmlspecialchars($this->sellerName);
        $email = htmlspecialchars($this->sellerEmail);
        $otp   = $this->otp;

        // 4 digit boxes — white cards on dark navy bg
        $digitCells = '';
        foreach (str_split($otp) as $digit) {
            $digitCells .= "
            <td style='padding:0 8px;'>
              <div style='
                width:72px;
                height:88px;
                background:#ffffff;
                border-radius:16px;
                font-size:48px;
                font-weight:900;
                color:#1a3c6e;
                text-align:center;
                line-height:88px;
                font-family:Georgia,serif;
                box-shadow:0 4px 20px rgba(0,0,0,0.2);
                display:inline-block;
              '>{$digit}</div>
            </td>";
        }

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body style="margin:0;padding:0;background:#f4f6fb;font-family:'Segoe UI',Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6fb;padding:36px 16px;">
<tr><td align="center">

<table width="580" cellpadding="0" cellspacing="0"
  style="max-width:580px;width:100%;border-radius:20px;overflow:hidden;box-shadow:0 4px 32px rgba(15,23,42,0.10);background:#ffffff;">

  <!-- ══ TOP LOGO HEADER (light bg, gray text) ══ -->
  <tr>
    <td style="background:#132d7c;padding:28px 40px 20px;border-bottom:1px solid #e8ecf4;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:middle;">
            <!-- Logo image — large and prominent -->
            <img src="https://www.globpulse.com/assets/img/logos/GFEPLUSE1.png"
                 alt="GlobPulse" height="52"
                 style="display:block;height:52px;max-width:220px;object-fit:contain;">
            <div style="font-size:10px;font-weight:700;color:#9ca3af;letter-spacing:2.5px;text-transform:uppercase;margin-top:4px;">
              THE PULSE OF GLOBAL TRADE
            </div>
          </td>
          <td style="text-align:right;vertical-align:middle;">
            <div style="display:inline-flex;align-items:center;gap:6px;border:1px solid #e2e8f0;border-radius:20px;padding:6px 14px;">
              <span style="font-size:14px;">✉️</span>
              <span style="font-size:11px;font-weight:700;color:#6b7280;letter-spacing:1.5px;text-transform:uppercase;">VERIFICATION</span>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- ══ BODY ══ -->
  <tr>
    <td style="background:#ffffff;padding:36px 40px 12px;">

      <!-- Title -->
      <h2 style="font-size:26px;font-weight:800;color:#111827;margin:0 0 10px;line-height:1.3;">
        Verify your email
      </h2>
      <p style="font-size:15px;color:#6b7280;line-height:1.8;margin:0 0 30px;">
        Hi <strong style="color:#111827;">{$name}</strong>,
        thank you for registering on <strong style="color:#1d4ed8;">GlobPulse</strong>.
        Use the code below to confirm your email address.
      </p>

    </td>
  </tr>

  <!-- ══ OTP DARK CARD ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px 32px;">

      <table width="100%" cellpadding="0" cellspacing="0"
        style="background:#1a2d5a;border-radius:18px;overflow:hidden;">
        <tr>
          <td style="padding:32px 24px;text-align:center;">

            <p style="font-size:11px;font-weight:700;color:rgba(255,255,255,0.6);letter-spacing:3px;text-transform:uppercase;margin:0 0 24px;">
              YOUR ONE-TIME VERIFICATION CODE
            </p>

            <!-- 4 white digit boxes -->
            <table cellpadding="0" cellspacing="0" style="margin:0 auto 24px;">
              <tr>{$digitCells}</tr>
            </table>

            <!-- Expiry pill -->
            <div style="display:inline-block;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);border-radius:20px;padding:7px 20px;">
              <span style="font-size:13px;color:rgba(255,255,255,0.8);font-weight:600;">
                ⏱ Expires in <strong style="color:#f59e0b;">10 minutes</strong>
              </span>
            </div>

          </td>
        </tr>
      </table>

    </td>
  </tr>

  <!-- ══ STEPS ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px 32px;">

      <!-- Step 1 -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
        <tr>
          <td style="width:50px;vertical-align:top;">
            <div style="width:40px;height:40px;border-radius:12px;background:#1d4ed8;text-align:center;line-height:40px;font-size:16px;font-weight:900;color:#fff;">1</div>
          </td>
          <td style="padding-left:14px;vertical-align:middle;">
            <div style="font-size:15px;font-weight:700;color:#111827;">Enter this code → verify email</div>
            <div style="font-size:13px;color:#9ca3af;margin-top:2px;">Your account gets activated instantly</div>
          </td>
          <td style="width:40px;text-align:right;vertical-align:middle;font-size:20px;">📨</td>
        </tr>
      </table>

      <!-- Step 2 -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
        <tr>
          <td style="width:50px;vertical-align:top;">
            <div style="width:40px;height:40px;border-radius:12px;background:#0891b2;text-align:center;line-height:40px;font-size:16px;font-weight:900;color:#fff;">2</div>
          </td>
          <td style="padding-left:14px;vertical-align:middle;">
            <div style="font-size:15px;font-weight:700;color:#111827;">Receive login credentials by email</div>
            <div style="font-size:13px;color:#9ca3af;margin-top:2px;">Email + password sent instantly</div>
          </td>
          <td style="width:40px;text-align:right;vertical-align:middle;font-size:20px;">🔑</td>
        </tr>
      </table>

      <!-- Step 3 -->
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="width:50px;vertical-align:top;">
            <div style="width:40px;height:40px;border-radius:12px;background:#059669;text-align:center;line-height:40px;font-size:16px;font-weight:900;color:#fff;">3</div>
          </td>
          <td style="padding-left:14px;vertical-align:middle;">
            <div style="font-size:15px;font-weight:700;color:#111827;">Complete profile → reach global buyers</div>
            <div style="font-size:13px;color:#9ca3af;margin-top:2px;">180+ countries · B2B verified buyers</div>
          </td>
          <td style="width:40px;text-align:right;vertical-align:middle;font-size:20px;">🌍</td>
        </tr>
      </table>

    </td>
  </tr>

  <!-- ══ SECURITY NOTICE ══ -->
  <tr>
    <td style="background:#fffbeb;padding:16px 40px;border-top:1px solid #fde68a;border-bottom:1px solid #fde68a;">
      <p style="font-size:13px;color:#78350f;margin:0;line-height:1.7;">
        🔒 <strong>Never share this code.</strong> GlobPulse will never ask for it via phone or WhatsApp.
        If you didn't register, ignore this email.
      </p>
    </td>
  </tr>

  <!-- ══ FOOTER (dark navy) ══ -->
  <tr>
    <td style="background:#1a2d5a;padding:24px 40px;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:middle;">
            <div style="font-size:20px;font-weight:900;color:#ffffff;letter-spacing:-0.5px;font-family:'Segoe UI',Arial,sans-serif;">
              Glob<span style="color:#38bdf8;">Pulse</span>
            </div>
            <div style="font-size:9px;font-weight:700;color:rgba(255,255,255,0.4);letter-spacing:2.5px;text-transform:uppercase;margin-top:3px;">
              B2B GLOBAL TRADE PLATFORM
            </div>
          </td>
          <td style="text-align:right;vertical-align:middle;">
            <div style="font-size:12px;color:rgba(255,255,255,0.5);">Sent to</div>
            <div style="font-size:12px;color:#93c5fd;font-weight:600;">{$email}</div>
            <div style="font-size:11px;color:rgba(255,255,255,0.35);margin-top:3px;">© {$year} GlobPulse</div>
          </td>
        </tr>
      </table>
    </td>
  </tr>

</table>
</td></tr>
</table>
</body>
</html>
HTML;
    }
}