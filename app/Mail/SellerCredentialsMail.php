<?php
// FILE: app/Mail/SellerCredentialsMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $sellerName,
        public string $sellerEmail,
        public string $tempPassword
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Welcome to GlobPulse — Your Seller Login Credentials',
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
        $year     = date('Y');
        $name     = htmlspecialchars($this->sellerName);
        $email    = htmlspecialchars($this->sellerEmail);
        $password = htmlspecialchars($this->tempPassword);
        $loginUrl = url('/seller/login');

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Welcome to GlobPulse</title>
</head>
<body style="margin:0;padding:0;background-color:#F1F5F9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Arial,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#F1F5F9;padding:48px 16px;">
    <tr>
      <td align="center">

        <!-- CARD -->
        <table width="580" cellpadding="0" cellspacing="0" border="0"
          style="max-width:580px;width:100%;background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 4px 40px rgba(15,23,42,0.12);">

          <!-- ═══ HEADER (green theme — success) ═══ -->
          <tr>
            <td style="background:linear-gradient(135deg,#0f172a 0%,#065f46 50%,#059669 100%);padding:44px 48px;text-align:center;">
              <img src="https://www.globpulse.com/assets/img/icons/gfe.svg"
                   alt="GlobPulse" height="44"
                   style="display:block;margin:0 auto 20px;max-width:160px;">

              <!-- Success icon -->
              <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 16px;">
                <tr>
                  <td style="width:68px;height:68px;background:rgba(255,255,255,0.15);border:2px solid rgba(255,255,255,0.25);border-radius:50%;text-align:center;vertical-align:middle;font-size:32px;line-height:68px;">
                    🎉
                  </td>
                </tr>
              </table>

              <p style="font-size:22px;font-weight:900;color:#ffffff;margin:0 0 6px;">Account Verified!</p>
              <p style="font-size:14px;color:rgba(255,255,255,0.75);margin:0;">Welcome to GlobPulse Seller Network</p>
            </td>
          </tr>

          <!-- ═══ BODY ═══ -->
          <tr>
            <td style="padding:44px 48px 36px;">

              <p style="font-size:22px;font-weight:800;color:#0F172A;margin:0 0 10px;">
                Welcome aboard, {$name}! 🚀
              </p>
              <p style="font-size:15px;color:#64748B;line-height:1.75;margin:0 0 32px;">
                Your email has been verified. Below are your <strong style="color:#059669;">GlobPulse Seller Dashboard</strong> login credentials.
                Please keep them safe.
              </p>

              <!-- ══ CREDENTIALS BOX ══ -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0"
                style="background:#F8FAFF;border:2px solid #BFDBFE;border-radius:16px;margin-bottom:32px;">
                <tr>
                  <td style="padding:28px 32px;">

                    <p style="font-size:11px;font-weight:800;color:#94A3B8;letter-spacing:2px;text-transform:uppercase;margin:0 0 20px;">
                      Your Login Credentials
                    </p>

                    <!-- Email -->
                    <p style="font-size:11px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;margin:0 0 6px;">
                      Email Address
                    </p>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:18px;">
                      <tr>
                        <td style="background:#ffffff;border:1.5px solid #E2E8F0;border-radius:10px;padding:13px 16px;font-size:15px;font-weight:700;color:#0F172A;font-family:'Courier New',Courier,monospace;">
                          {$email}
                        </td>
                      </tr>
                    </table>

                    <!-- Password -->
                    <p style="font-size:11px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;margin:0 0 6px;">
                      Temporary Password
                    </p>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:18px;">
                      <tr>
                        <td style="background:#ffffff;border:1.5px solid #BFDBFE;border-radius:10px;padding:14px 16px;font-size:22px;font-weight:900;color:#1D4ED8;font-family:'Courier New',Courier,monospace;letter-spacing:4px;">
                          {$password}
                        </td>
                      </tr>
                    </table>

                    <!-- Warning -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="background:#FEF3C7;border:1px solid #FDE68A;border-radius:10px;padding:12px 16px;">
                          <p style="font-size:13px;color:#92400E;margin:0;line-height:1.6;">
                            ⚠️ <strong>You will be asked to change this password on first login</strong> for your account security.
                          </p>
                        </td>
                      </tr>
                    </table>

                  </td>
                </tr>
              </table>

              <!-- ══ LOGIN BUTTON ══ -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                <tr>
                  <td align="center">
                    <a href="{$loginUrl}"
                       style="display:inline-block;background:#1D4ED8;color:#ffffff;text-decoration:none;padding:17px 52px;border-radius:12px;font-size:16px;font-weight:800;letter-spacing:0.3px;">
                      Sign In to Seller Dashboard &rarr;
                    </a>
                  </td>
                </tr>
              </table>

              <!-- DIVIDER -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                <tr><td style="border-top:1px solid #E2E8F0;"></td></tr>
              </table>

              <!-- ══ NEXT STEPS ══ -->
              <p style="font-size:11px;font-weight:800;color:#374151;margin:0 0 18px;text-transform:uppercase;letter-spacing:1.5px;">
                Complete your profile to go live
              </p>

              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td width="36" valign="top" style="padding-bottom:14px;">
                    <div style="width:28px;height:28px;border-radius:50%;background:#DCFCE7;border:1.5px solid #86EFAC;text-align:center;line-height:26px;font-size:14px;font-weight:900;color:#16A34A;">✓</div>
                  </td>
                  <td style="font-size:14px;color:#475569;padding-bottom:14px;padding-left:8px;line-height:1.6;">
                    <strong style="color:#059669;">Email verified</strong> — done! ✅
                  </td>
                </tr>
                <tr>
                  <td width="36" valign="top" style="padding-bottom:14px;">
                    <div style="width:28px;height:28px;border-radius:50%;background:#DBEAFE;text-align:center;line-height:28px;font-size:12px;font-weight:800;color:#1D4ED8;">2</div>
                  </td>
                  <td style="font-size:14px;color:#475569;padding-bottom:14px;padding-left:8px;line-height:1.6;">
                    Sign in and <strong>set a new password</strong> (required on first login)
                  </td>
                </tr>
                <tr>
                  <td width="36" valign="top" style="padding-bottom:14px;">
                    <div style="width:28px;height:28px;border-radius:50%;background:#DBEAFE;text-align:center;line-height:28px;font-size:12px;font-weight:800;color:#1D4ED8;">3</div>
                  </td>
                  <td style="font-size:14px;color:#475569;padding-bottom:14px;padding-left:8px;line-height:1.6;">
                    Complete your <strong>business profile</strong> and upload KYC documents
                  </td>
                </tr>
                <tr>
                  <td width="36" valign="top">
                    <div style="width:28px;height:28px;border-radius:50%;background:#DBEAFE;text-align:center;line-height:28px;font-size:12px;font-weight:800;color:#1D4ED8;">4</div>
                  </td>
                  <td style="font-size:14px;color:#475569;padding-left:8px;line-height:1.6;">
                    Go live and start receiving <strong>buyer inquiries from 180+ countries</strong> 🌍
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