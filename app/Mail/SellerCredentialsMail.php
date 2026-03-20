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
        return new Content(htmlString: $this->buildHtml());
    }

    private function buildHtml(): string
    {
        $year       = date('Y');
        $name       = htmlspecialchars($this->sellerName);
        $email      = htmlspecialchars($this->sellerEmail);
        $password   = htmlspecialchars($this->tempPassword);
        $loginUrl   = url('/seller/login');
        $androidUrl = 'https://play.google.com/store/apps/details?id=crm.ani.com';
        $iosUrl     = 'https://apps.apple.com/us/app/globpulse-b2b-marketplace/id6742694568';
        $logoUrl    = url('assets/img/logos/GFEPLUSE.png');

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body style="margin:0;padding:0;background:#f0f4fb;font-family:'Segoe UI',Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4fb;padding:40px 16px;">
<tr><td align="center">

<table width="600" cellpadding="0" cellspacing="0"
  style="max-width:600px;width:100%;border-radius:24px;overflow:hidden;box-shadow:0 8px 40px rgba(15,23,42,0.12);background:#ffffff;">

  <!-- ══ HEADER ══ -->
  <tr>
    <td style="background:linear-gradient(135deg,#1a2d5a 0%,#1d4ed8 100%);padding:32px 40px 28px;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:middle;">
            <img src="https://www.globpulse.com/assets/img/logos/GFEPLUSE1.png"
                 alt="GlobPulse" height="48"
                 style="display:block;height:48px;max-width:200px;object-fit:contain;">
            <div style="font-size:9px;font-weight:700;color:rgba(255,255,255,0.5);letter-spacing:3px;text-transform:uppercase;margin-top:5px;">
              THE PULSE OF GLOBAL TRADE
            </div>
          </td>
          <td style="text-align:right;vertical-align:middle;">
            <div style="background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);border-radius:50px;padding:8px 18px;display:inline-block;">
              <span style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.9);letter-spacing:2px;text-transform:uppercase;">🎉 WELCOME</span>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- ══ HERO GREETING ══ -->
  <tr>
    <td style="background:#ffffff;padding:36px 40px 28px;">
      <h2 style="font-size:26px;font-weight:800;color:#0f172a;margin:0 0 12px;line-height:1.3;">
        Welcome aboard, {$name}! 🚀
      </h2>
      <p style="font-size:15px;color:#64748b;line-height:1.8;margin:0;">
        Your email has been verified. Below are your
        <strong style="color:#1d4ed8;">GlobPulse Seller Dashboard</strong> login credentials.
        Keep them safe!
      </p>
    </td>
  </tr>

  <!-- ══ CREDENTIALS CARD ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px 32px;">
      <table width="100%" cellpadding="0" cellspacing="0"
        style="background:#0f172a;border-radius:20px;overflow:hidden;">
        <tr>
          <td style="padding:30px 32px;">

            <p style="font-size:10px;font-weight:700;color:rgba(255,255,255,0.4);letter-spacing:4px;text-transform:uppercase;margin:0 0 22px;">
              🔐 YOUR LOGIN CREDENTIALS
            </p>

            <!-- Email -->
            <p style="font-size:10px;font-weight:700;color:rgba(255,255,255,0.45);text-transform:uppercase;letter-spacing:2px;margin:0 0 7px;">Email Address</p>
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:22px;">
              <tr>
                <td style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:14px 18px;">
                  <span style="font-size:15px;font-weight:600;color:#e2e8f0;font-family:'Courier New',monospace;">{$email}</span>
                </td>
              </tr>
            </table>

            <!-- Password -->
            <p style="font-size:10px;font-weight:700;color:rgba(255,255,255,0.45);text-transform:uppercase;letter-spacing:2px;margin:0 0 7px;">Temporary Password</p>
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:22px;">
              <tr>
                <td style="background:rgba(56,189,248,0.08);border:2px solid #38bdf8;border-radius:14px;padding:18px;text-align:center;">
                  <span style="font-size:36px;font-weight:900;color:#38bdf8;font-family:'Courier New',monospace;letter-spacing:10px;">{$password}</span>
                </td>
              </tr>
            </table>

            <!-- Warning -->
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.35);border-radius:12px;padding:14px 18px;">
                  <p style="font-size:13px;color:#fde68a;margin:0;line-height:1.7;">
                    ⚠️ &nbsp;<strong>Change this password on first login</strong> — this is required for your account security.
                  </p>
                </td>
              </tr>
            </table>

          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- ══ LOGIN BUTTON ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px 36px;text-align:center;">
      <a href="{$loginUrl}"
         style="display:inline-block;background:linear-gradient(135deg,#1d4ed8,#2563eb);color:#ffffff;text-decoration:none;padding:17px 56px;border-radius:14px;font-size:16px;font-weight:800;letter-spacing:0.3px;box-shadow:0 8px 24px rgba(29,78,216,0.35);">
        Sign In to Seller Dashboard &nbsp;→
      </a>
      <p style="font-size:12px;color:#94a3b8;margin:14px 0 0;">
        Or visit: <a href="{$loginUrl}" style="color:#1d4ed8;text-decoration:none;">{$loginUrl}</a>
      </p>
    </td>
  </tr>

  <!-- ══ DIVIDER ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px;">
      <div style="height:1px;background:#f1f5f9;margin-bottom:32px;"></div>
    </td>
  </tr>

  <!-- ══ NEXT STEPS ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px 32px;">
      <p style="font-size:11px;font-weight:800;color:#94a3b8;letter-spacing:3px;text-transform:uppercase;margin:0 0 20px;">
        Next Steps to Go Live
      </p>

      <!-- Step 1 done -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
        <tr>
          <td style="width:48px;vertical-align:top;">
            <div style="width:44px;height:44px;border-radius:14px;background:#dcfce7;text-align:center;line-height:44px;font-size:20px;">✅</div>
          </td>
          <td style="padding-left:16px;vertical-align:middle;">
            <div style="font-size:15px;font-weight:700;color:#16a34a;">Email Verified</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:3px;">Account created successfully</div>
          </td>
        </tr>
      </table>

      <!-- Step 2 -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
        <tr>
          <td style="width:48px;vertical-align:top;">
            <div style="width:44px;height:44px;border-radius:14px;background:#dbeafe;text-align:center;line-height:44px;font-size:20px;">🔑</div>
          </td>
          <td style="padding-left:16px;vertical-align:middle;">
            <div style="font-size:15px;font-weight:700;color:#0f172a;">Set a new secure password</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:3px;">Required on first login</div>
          </td>
        </tr>
      </table>

      <!-- Step 3 -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
        <tr>
          <td style="width:48px;vertical-align:top;">
            <div style="width:44px;height:44px;border-radius:14px;background:#dbeafe;text-align:center;line-height:44px;font-size:20px;">📋</div>
          </td>
          <td style="padding-left:16px;vertical-align:middle;">
            <div style="font-size:15px;font-weight:700;color:#0f172a;">Complete business profile &amp; KYC</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:3px;">Takes less than 10 minutes</div>
          </td>
        </tr>
      </table>

      <!-- Step 4 -->
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="width:48px;vertical-align:top;">
            <div style="width:44px;height:44px;border-radius:14px;background:#dbeafe;text-align:center;line-height:44px;font-size:20px;">🌍</div>
          </td>
          <td style="padding-left:16px;vertical-align:middle;">
            <div style="font-size:15px;font-weight:700;color:#0f172a;">Get approved &amp; go live</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:3px;">Reach B2B buyers in 180+ countries</div>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- ══ DIVIDER ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px;">
      <div style="height:1px;background:#f1f5f9;margin-bottom:32px;"></div>
    </td>
  </tr>

  <!-- ══ APP DOWNLOAD ══ -->
  <tr>
    <td style="background:#ffffff;padding:0 40px 36px;">

      <p style="font-size:11px;font-weight:800;color:#94a3b8;letter-spacing:3px;text-transform:uppercase;margin:0 0 8px;">
        📱 Manage on the Go
      </p>
      <p style="font-size:14px;color:#64748b;margin:0 0 22px;line-height:1.7;">
        Download the GlobPulse app to manage leads, enquiries &amp; products from anywhere.
      </p>

      <table cellpadding="0" cellspacing="0">
        <tr>

          <!-- ── Google Play Button ── -->
          <td style="padding-right:14px;">
            <a href="{$androidUrl}" target="_blank" style="text-decoration:none;display:block;">
              <table cellpadding="0" cellspacing="0"
                style="background:#000000;border-radius:14px;border:1.5px solid #333333;min-width:170px;">
                <tr>
                  <td style="padding:10px 20px;">
                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <!-- Google Play SVG Icon -->
                        <td style="vertical-align:middle;padding-right:12px;">
                          <svg width="26" height="28" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 0.5L13.5 12.5L1.5 24.5C0.9 24.2 0.5 23.6 0.5 23V2C0.5 1.4 0.9 0.8 1.5 0.5Z" fill="#EA4335"/>
                            <path d="M18.5 8L13.5 12.5L18.5 17L22.5 14.8C23.5 14.2 23.5 13.8 22.5 13.2L18.5 8Z" fill="#FBBC04"/>
                            <path d="M1.5 0.5L13.5 12.5L18.5 8L4 0.2C3.2 -0.1 2.2 0 1.5 0.5Z" fill="#4285F4"/>
                            <path d="M1.5 24.5L13.5 12.5L18.5 17L4 24.8C3.2 25.1 2.2 25 1.5 24.5Z" fill="#34A853"/>
                          </svg>
                        </td>
                        <td style="vertical-align:middle;">
                          <div style="font-size:9px;color:#aaaaaa;letter-spacing:0.5px;margin-bottom:2px;white-space:nowrap;">GET IT ON</div>
                          <div style="font-size:18px;font-weight:700;color:#ffffff;line-height:1.1;white-space:nowrap;font-family:'Segoe UI',Arial,sans-serif;">Google Play</div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </a>
          </td>

          <!-- ── App Store Button ── -->
          <td>
            <a href="{$iosUrl}" target="_blank" style="text-decoration:none;display:block;">
              <table cellpadding="0" cellspacing="0"
                style="background:#000000;border-radius:14px;border:1.5px solid #333333;min-width:170px;">
                <tr>
                  <td style="padding:10px 20px;">
                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <!-- Apple SVG Icon -->
                        <td style="vertical-align:middle;padding-right:12px;">
                          <svg width="24" height="28" viewBox="0 0 24 28" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.1 21.5C19.4 23 18.6 24.4 17.6 25.6C16.2 27.3 15 28 13.7 28C12.7 28 11.4 27.7 9.9 27C8.4 26.3 7 26 5.8 26C4.5 26 3.1 26.3 1.6 27C0.1 27.7 -0.8 28 -1.3 28C-2.7 28 -4 27.2 -5.3 25.5C-6.7 23.8 -7.9 21.7 -8.8 19.1C-9.8 16.3 -10.3 13.6 -10.3 11.1C-10.3 8.3 -9.7 5.9 -8.4 4C-7.4 2.4 -6 1.2 -4.4 0.4C-2.8 -0.4 -1 -0.8 0.8 -0.8C1.9 -0.8 3.4 -0.4 5.2 0.3C7 1 8.2 1.4 8.9 1.4C9.4 1.4 10.7 1 13 0.2C15.1 -0.5 17 -0.2 18.5 1C19.8 2 20.7 3.4 21.1 5.3C19.6 6.1 18.5 7.2 17.8 8.6C17.1 10 16.9 11.5 17.2 13.1C17.5 14.6 18.1 15.9 19.1 17C19.8 17.7 20.5 18.3 21.4 18.7C21 19.7 20.6 20.6 20.1 21.5Z" 
                                  transform="translate(11, 0)" fill="#ffffff"/>
                            <path d="M15.5 0C15.6 1.6 15.1 3.1 14 4.4C12.9 5.7 11.5 6.5 9.9 6.4C9.8 4.9 10.4 3.4 11.5 2.2C12.6 0.9 14 0.1 15.5 0Z" 
                                  fill="#ffffff"/>
                          </svg>
                        </td>
                        <td style="vertical-align:middle;">
                          <div style="font-size:9px;color:#aaaaaa;letter-spacing:0.5px;margin-bottom:2px;white-space:nowrap;">DOWNLOAD ON THE</div>
                          <div style="font-size:18px;font-weight:700;color:#ffffff;line-height:1.1;white-space:nowrap;font-family:'Segoe UI',Arial,sans-serif;">App Store</div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </a>
          </td>

        </tr>
      </table>

    </td>
  </tr>

  <!-- ══ SECURITY NOTICE ══ -->
  <tr>
    <td style="background:#fffbeb;padding:16px 40px;border-top:1px solid #fde68a;border-bottom:1px solid #fde68a;">
      <p style="font-size:13px;color:#78350f;margin:0;line-height:1.7;">
        🔒 &nbsp;<strong>Never share your password.</strong> GlobPulse will never ask for your credentials via phone or WhatsApp.
      </p>
    </td>
  </tr>

  <!-- ══ FOOTER ══ -->
  <tr>
    <td style="background:linear-gradient(135deg,#0f172a,#1a2d5a);padding:28px 40px;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:middle;">
            <div style="font-size:22px;font-weight:900;color:#ffffff;letter-spacing:-0.5px;font-family:'Segoe UI',Arial,sans-serif;">
              Glob<span style="color:#38bdf8;">Pulse</span>
            </div>
            <div style="font-size:9px;font-weight:700;color:rgba(255,255,255,0.35);letter-spacing:3px;text-transform:uppercase;margin-top:4px;">
              B2B GLOBAL TRADE PLATFORM
            </div>
          </td>
          <td style="text-align:right;vertical-align:middle;">
            <div style="font-size:12px;color:rgba(255,255,255,0.45);">Sent to</div>
            <div style="font-size:13px;color:#93c5fd;font-weight:600;">{$email}</div>
            <div style="font-size:11px;color:rgba(255,255,255,0.3);margin-top:4px;">© {$year} GlobPulse. All rights reserved.</div>
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