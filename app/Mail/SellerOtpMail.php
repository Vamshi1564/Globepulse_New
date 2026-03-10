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
            subject: 'Your GlobPulse Email Verification Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: $this->buildHtml(),
        );
    }

    private function buildHtml(): string
    {
        $year      = date('Y');
        $name      = htmlspecialchars($this->sellerName);
        $email     = htmlspecialchars($this->sellerEmail);

        // Build 6 individual digit boxes
        $boxes = '';
        foreach (str_split($this->otp) as $digit) {
            $boxes .= "
            <td style='padding:0 6px'>
              <table cellpadding='0' cellspacing='0'>
                <tr>
                  <td style='
                    width:52px;height:64px;
                    background:#EFF6FF;
                    border:2.5px solid #93C5FD;
                    border-radius:12px;
                    font-size:32px;font-weight:900;
                    color:#1D4ED8;
                    text-align:center;
                    vertical-align:middle;
                    font-family:Courier New,Courier,monospace;
                    line-height:64px;
                  '>{$digit}</td>
                </tr>
              </table>
            </td>";
        }

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>GlobPulse — Email Verification</title>
</head>
<body style="margin:0;padding:0;background-color:#F1F5F9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Arial,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#F1F5F9;padding:48px 16px;">
    <tr>
      <td align="center">

        <!-- CARD -->
        <table width="580" cellpadding="0" cellspacing="0" border="0"
          style="max-width:580px;width:100%;background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 4px 40px rgba(15,23,42,0.12);">

          <!-- ═══ HEADER ═══ -->
          <tr>
            <td style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 55%,#2563eb 100%);padding:40px 48px;text-align:center;">
              <img src="https://www.globpulse.com/assets/img/icons/gfe.svg"
                   alt="GlobPulse" height="44"
                   style="display:block;margin:0 auto 16px;max-width:160px;">
              <div style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);border-radius:30px;padding:6px 20px;">
                <span style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.9);letter-spacing:2.5px;text-transform:uppercase;">
                  Email Verification
                </span>
              </div>
            </td>
          </tr>

          <!-- ═══ BODY ═══ -->
          <tr>
            <td style="padding:44px 48px 36px;">

              <!-- Greeting -->
              <p style="font-size:24px;font-weight:800;color:#0F172A;margin:0 0 10px;line-height:1.3;">
                Hello, {$name}! 👋
              </p>
              <p style="font-size:15px;color:#64748B;line-height:1.75;margin:0 0 36px;">
                Thank you for registering on <strong style="color:#1D4ED8;">GlobPulse</strong>.
                Use the verification code below to confirm your email address.
              </p>

              <!-- OTP Label -->
              <p style="font-size:11px;font-weight:800;color:#94A3B8;text-align:center;letter-spacing:2px;text-transform:uppercase;margin:0 0 14px;">
                Your verification code
              </p>

              <!-- OTP DIGIT BOXES -->
              <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 10px;">
                <tr>{$boxes}</tr>
              </table>

              <!-- Expiry note -->
              <p style="text-align:center;font-size:13px;color:#94A3B8;margin:0 0 36px;">
                ⏱ &nbsp;This code expires in&nbsp;
                <strong style="color:#EF4444;">10 minutes</strong>
              </p>

              <!-- DIVIDER -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                <tr>
                  <td style="border-top:1px solid #E2E8F0;height:1px;"></td>
                </tr>
              </table>

              <!-- WHAT HAPPENS NEXT -->
              <p style="font-size:11px;font-weight:800;color:#374151;margin:0 0 18px;text-transform:uppercase;letter-spacing:1.5px;">
                What happens next
              </p>

              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td width="36" valign="top" style="padding-bottom:14px;">
                    <div style="width:28px;height:28px;border-radius:50%;background:#DBEAFE;text-align:center;line-height:28px;font-size:12px;font-weight:800;color:#1D4ED8;">1</div>
                  </td>
                  <td style="font-size:14px;color:#475569;padding-bottom:14px;padding-left:8px;line-height:1.6;">
                    Enter this OTP on the verification page
                  </td>
                </tr>
                <tr>
                  <td width="36" valign="top" style="padding-bottom:14px;">
                    <div style="width:28px;height:28px;border-radius:50%;background:#DBEAFE;text-align:center;line-height:28px;font-size:12px;font-weight:800;color:#1D4ED8;">2</div>
                  </td>
                  <td style="font-size:14px;color:#475569;padding-bottom:14px;padding-left:8px;line-height:1.6;">
                    Your login credentials (email + password) will be emailed to you instantly
                  </td>
                </tr>
                <tr>
                  <td width="36" valign="top">
                    <div style="width:28px;height:28px;border-radius:50%;background:#DBEAFE;text-align:center;line-height:28px;font-size:12px;font-weight:800;color:#1D4ED8;">3</div>
                  </td>
                  <td style="font-size:14px;color:#475569;padding-left:8px;line-height:1.6;">
                    Login and complete your seller profile to start receiving buyer inquiries
                  </td>
                </tr>
              </table>

              <!-- Security warning -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:28px;">
                <tr>
                  <td style="background:#FFF7ED;border:1px solid #FED7AA;border-radius:12px;padding:16px 20px;">
                    <p style="font-size:13px;color:#92400E;margin:0;line-height:1.6;">
                      🔒 <strong>Security notice:</strong> GlobPulse will never ask you for this code over the phone or chat.
                      If you did not create an account, you can safely ignore this email.
                    </p>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- ═══ FOOTER ═══ -->
          <tr>
            <td style="background:#F8FAFC;border-top:1px solid #E2E8F0;padding:24px 48px;text-align:center;">
              <p style="font-size:13px;color:#94A3B8;margin:0 0 6px;">
                This email was sent to <strong style="color:#64748B;">{$email}</strong>
              </p>
              <p style="font-size:12px;color:#CBD5E1;margin:0;">
                © {$year} GlobPulse &nbsp;·&nbsp; All rights reserved
              </p>
            </td>
          </tr>

        </table>
        <!-- END CARD -->

      </td>
    </tr>
  </table>

</body>
</html>
HTML;
    }
}