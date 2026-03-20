<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BuyerOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $otp,
        public string $buyerName,
        public string $buyerEmail
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your GlobPulse Buyer Verification Code',
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
        $year  = date('Y');
        $name  = htmlspecialchars($this->buyerName);
        $email = htmlspecialchars($this->buyerEmail);

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

<h2>Hello {$name} 👋</h2>

<p>Welcome to <b>GlobPulse Buyer Network</b>.</p>

<p>Please verify your email using this code:</p>

<table align="center" cellpadding="0" cellspacing="0">
<tr>{$boxes}</tr>
</table>

<p style="text-align:center;margin-top:15px">
This OTP expires in <b style="color:red">10 minutes</b>.
</p>

<hr>

<p style="font-size:13px;color:#64748B">
If you did not create a buyer account, please ignore this email.
</p>

</td>
</tr>

<tr>
<td style="text-align:center;color:#94A3B8;font-size:12px">
© {$year} GlobPulse
</td>
</tr>

</table>

</body>
</html>
HTML;
    }
}