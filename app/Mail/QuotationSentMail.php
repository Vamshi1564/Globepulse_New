<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationSentMail extends Mailable
{
    use SerializesModels;

    public $quotation;

    public function __construct($quotation)
    {
        $this->quotation = $quotation;
    }

    public function build()
    {
        return $this->subject('New Quotation Received')
            ->view('emails.quotation-sent');
    }
}