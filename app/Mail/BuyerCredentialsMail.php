<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BuyerCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $buyerName,
        public string $buyerEmail,
        public string $tempPassword
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Welcome to GlobPulse — Your Buyer Login Credentials',
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
        $name     = htmlspecialchars($this->buyerName);
        $email    = htmlspecialchars($this->buyerEmail);
        $password = htmlspecialchars($this->tempPassword);
        $loginUrl = url('/buyer/login');

        return <<<HTML
<!DOCTYPE html>
<html>
<body style="background:#F1F5F9;font-family:Arial;padding:40px">

<table width="580" align="center" style="background:#fff;border-radius:16px;padding:40px">

<tr>
<td align="center" style="background:#222; padding:20px;">
  <img 
    src="https://www.globpulse.com/assets/img/logos/GFEPLUSE1.png"
    width="260"
    alt="GlobPulse"
    style="display:block; margin:auto; max-width:100%; height:auto;"
  >
</td>
</tr>

<tr>
<td>

<h2>Welcome {$name}! 🎉</h2>

<p>Your email has been verified successfully.</p>

<p>Below are your <b>GlobPulse Buyer login credentials</b>.</p>

<table width="100%" style="background:#F8FAFF;border:1px solid #E2E8F0;padding:20px;border-radius:10px">

<tr>
<td style="font-size:13px;color:#64748B">Email</td>
</tr>

<tr>
<td style="font-size:16px;font-weight:700;padding-bottom:15px">
{$email}
</td>
</tr>

<tr>
<td style="font-size:13px;color:#64748B">Temporary Password</td>
</tr>

<tr>
<td style="font-size:22px;font-weight:900;color:#2563EB;letter-spacing:3px">
{$password}
</td>
</tr>

</table>

<br>

<a href="{$loginUrl}"
style="display:inline-block;background:#2563EB;color:#fff;padding:14px 35px;border-radius:8px;text-decoration:none;font-weight:700">
Login to Buyer Dashboard →
</a>

<br><br>

<p style="font-size:13px;color:#64748B">
⚠️ You will be asked to change this password on first login for security.
</p>

<hr>

<p style="font-size:12px;color:#94A3B8">
© {$year} GlobPulse. All rights reserved.
</p>

</td>
</tr>

</table>

</body>
</html>
HTML;
    }
}