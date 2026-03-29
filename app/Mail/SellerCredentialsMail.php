<?php
// FILE: app/Mail/SellerCredentialsMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $sellerName;
    public string $sellerEmail;
    public string $tempPassword;

    public function __construct(string $sellerName, string $sellerEmail, string $tempPassword)
    {
        $this->sellerName   = $sellerName;
        $this->sellerEmail  = $sellerEmail;
        $this->tempPassword = $tempPassword;
    }

    /**
     * Use build() — works on Laravel 9, 10, 11.
     * Avoids Content(htmlString:) which silently fails on some Laravel versions.
     */
    public function build(): static
    {
        return $this
            ->subject('🎉 Welcome to GlobPulse — Your Seller Login Credentials')
            ->html($this->buildHtml());
    }

    private function buildHtml(): string
    {
        $year       = date('Y');
        $name       = htmlspecialchars($this->sellerName,   ENT_QUOTES, 'UTF-8');
        $email      = htmlspecialchars($this->sellerEmail,  ENT_QUOTES, 'UTF-8');
        $password   = htmlspecialchars($this->tempPassword, ENT_QUOTES, 'UTF-8');
        $loginUrl   = url('/seller/login');
        $androidUrl = 'https://play.google.com/store/apps/details?id=crm.ani.com';
        $iosUrl     = 'https://apps.apple.com/us/app/globpulse-b2b-marketplace/id6742694568';

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

  <!-- HEADER -->
  <tr>
    <td style="background:linear-gradient(135deg,#1a2d5a 0%,#1d4ed8 100%);padding:32px 40px 28px;">
      <table width="100%" cellpadding="0" cellspacing="0"><tr>
        <td>
          <img src="https://www.globpulse.com/assets/img/logos/GFEPLUSE1.png" alt="GlobPulse" height="48"
               style="display:block;height:48px;max-width:200px;object-fit:contain;">
          <div style="font-size:9px;font-weight:700;color:rgba(255,255,255,0.5);letter-spacing:3px;text-transform:uppercase;margin-top:5px;">THE PULSE OF GLOBAL TRADE</div>
        </td>
        <td style="text-align:right;vertical-align:middle;">
          <div style="background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);border-radius:50px;padding:8px 18px;display:inline-block;">
            <span style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.9);letter-spacing:2px;text-transform:uppercase;">&#x1F389; WELCOME</span>
          </div>
        </td>
      </tr></table>
    </td>
  </tr>

  <!-- GREETING -->
  <tr>
    <td style="padding:36px 40px 28px;">
      <h2 style="font-size:26px;font-weight:800;color:#0f172a;margin:0 0 12px;">Welcome aboard, {$name}! &#x1F680;</h2>
      <p style="font-size:15px;color:#64748b;line-height:1.8;margin:0;">
        Your email has been verified. Below are your <strong style="color:#1d4ed8;">GlobPulse Seller Dashboard</strong> login credentials. Keep them safe!
      </p>
    </td>
  </tr>

  <!-- CREDENTIALS CARD -->
  <tr>
    <td style="padding:0 40px 32px;">
      <table width="100%" cellpadding="0" cellspacing="0" style="background:#0f172a;border-radius:20px;">
        <tr><td style="padding:30px 32px;">
          <p style="font-size:10px;font-weight:700;color:rgba(255,255,255,0.4);letter-spacing:4px;text-transform:uppercase;margin:0 0 22px;">&#x1F510; YOUR LOGIN CREDENTIALS</p>

          <p style="font-size:10px;font-weight:700;color:rgba(255,255,255,0.45);text-transform:uppercase;letter-spacing:2px;margin:0 0 7px;">Email Address</p>
          <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:22px;"><tr>
            <td style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:14px 18px;">
              <span style="font-size:15px;font-weight:600;color:#e2e8f0;font-family:'Courier New',monospace;">{$email}</span>
            </td>
          </tr></table>

          <p style="font-size:10px;font-weight:700;color:rgba(255,255,255,0.45);text-transform:uppercase;letter-spacing:2px;margin:0 0 7px;">Temporary Password</p>
          <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:22px;"><tr>
            <td style="background:rgba(56,189,248,0.08);border:2px solid #38bdf8;border-radius:14px;padding:18px;text-align:center;">
              <span style="font-size:30px;font-weight:900;color:#38bdf8;font-family:'Courier New',monospace;letter-spacing:8px;">{$password}</span>
            </td>
          </tr></table>

          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td style="background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.35);border-radius:12px;padding:14px 18px;">
              <p style="font-size:13px;color:#fde68a;margin:0;line-height:1.7;">
                &#x26A0;&#xFE0F; &nbsp;<strong>Change this password on first login</strong> — required for your account security.
              </p>
            </td>
          </tr></table>
        </td></tr>
      </table>
    </td>
  </tr>

  <!-- LOGIN BUTTON -->
  <tr>
    <td style="padding:0 40px 36px;text-align:center;">
      <a href="{$loginUrl}" style="display:inline-block;background:linear-gradient(135deg,#1d4ed8,#2563eb);color:#ffffff;text-decoration:none;padding:17px 56px;border-radius:14px;font-size:16px;font-weight:800;box-shadow:0 8px 24px rgba(29,78,216,0.35);">
        Sign In to Seller Dashboard &nbsp;&rarr;
      </a>
      <p style="font-size:12px;color:#94a3b8;margin:14px 0 0;">
        Or visit: <a href="{$loginUrl}" style="color:#1d4ed8;text-decoration:none;">{$loginUrl}</a>
      </p>
    </td>
  </tr>

  <!-- NEXT STEPS -->
  <tr>
    <td style="padding:0 40px 32px;border-top:1px solid #f1f5f9;">
      <p style="font-size:11px;font-weight:800;color:#94a3b8;letter-spacing:3px;text-transform:uppercase;margin:24px 0 20px;">Next Steps to Go Live</p>
      <table width="100%" cellpadding="0" cellspacing="6">
        <tr><td style="padding:6px 0;">
          <table cellpadding="0" cellspacing="0"><tr>
            <td style="width:44px;height:44px;border-radius:14px;background:#dcfce7;text-align:center;vertical-align:middle;font-size:18px;">&#x2705;</td>
            <td style="padding-left:14px;vertical-align:middle;">
              <div style="font-size:14px;font-weight:700;color:#16a34a;">Email Verified — Account Ready</div>
            </td>
          </tr></table>
        </td></tr>
        <tr><td style="padding:6px 0;">
          <table cellpadding="0" cellspacing="0"><tr>
            <td style="width:44px;height:44px;border-radius:14px;background:#dbeafe;text-align:center;vertical-align:middle;font-size:18px;">&#x1F511;</td>
            <td style="padding-left:14px;vertical-align:middle;">
              <div style="font-size:14px;font-weight:700;color:#0f172a;">Set a new secure password on first login</div>
            </td>
          </tr></table>
        </td></tr>
        <tr><td style="padding:6px 0;">
          <table cellpadding="0" cellspacing="0"><tr>
            <td style="width:44px;height:44px;border-radius:14px;background:#dbeafe;text-align:center;vertical-align:middle;font-size:18px;">&#x1F4CB;</td>
            <td style="padding-left:14px;vertical-align:middle;">
              <div style="font-size:14px;font-weight:700;color:#0f172a;">Complete business profile &amp; KYC (10 mins)</div>
            </td>
          </tr></table>
        </td></tr>
        <tr><td style="padding:6px 0;">
          <table cellpadding="0" cellspacing="0"><tr>
            <td style="width:44px;height:44px;border-radius:14px;background:#dbeafe;text-align:center;vertical-align:middle;font-size:18px;">&#x1F30D;</td>
            <td style="padding-left:14px;vertical-align:middle;">
              <div style="font-size:14px;font-weight:700;color:#0f172a;">Get approved &amp; reach buyers in 180+ countries</div>
            </td>
          </tr></table>
        </td></tr>
      </table>
    </td>
  </tr>

  <!-- APP DOWNLOAD -->
  <tr>
    <td style="background:#f8fafc;padding:20px 40px;border-top:1px solid #e2e8f0;">
      <p style="font-size:13px;font-weight:700;color:#475569;margin:0 0 12px;">&#x1F4F1; Manage on the Go</p>
      <table cellpadding="0" cellspacing="0"><tr>
        <td style="padding-right:10px;">
          <a href="{$androidUrl}" target="_blank" style="display:inline-block;background:#000;color:#fff;text-decoration:none;padding:10px 20px;border-radius:10px;font-size:13px;font-weight:700;">&#x25B6; Google Play</a>
        </td>
        <td>
          <a href="{$iosUrl}" target="_blank" style="display:inline-block;background:#000;color:#fff;text-decoration:none;padding:10px 20px;border-radius:10px;font-size:13px;font-weight:700;">&#xF8FF; App Store</a>
        </td>
      </tr></table>
    </td>
  </tr>

  <!-- SECURITY NOTICE -->
  <tr>
    <td style="background:#fffbeb;padding:14px 40px;border-top:1px solid #fde68a;">
      <p style="font-size:13px;color:#78350f;margin:0;">&#x1F512; <strong>Never share your password.</strong> GlobPulse will never ask for credentials via phone or WhatsApp.</p>
    </td>
  </tr>

  <!-- FOOTER -->
  <tr>
    <td style="background:linear-gradient(135deg,#0f172a,#1a2d5a);padding:24px 40px;">
      <table width="100%" cellpadding="0" cellspacing="0"><tr>
        <td><div style="font-size:20px;font-weight:900;color:#fff;">Glob<span style="color:#38bdf8;">Pulse</span></div>
          <div style="font-size:9px;color:rgba(255,255,255,0.35);letter-spacing:3px;text-transform:uppercase;margin-top:3px;">B2B GLOBAL TRADE PLATFORM</div>
        </td>
        <td style="text-align:right;">
          <div style="font-size:12px;color:rgba(255,255,255,0.45);">Sent to</div>
          <div style="font-size:13px;color:#93c5fd;font-weight:600;">{$email}</div>
          <div style="font-size:11px;color:rgba(255,255,255,0.3);margin-top:3px;">&copy; {$year} GlobPulse. All rights reserved.</div>
        </td>
      </tr></table>
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