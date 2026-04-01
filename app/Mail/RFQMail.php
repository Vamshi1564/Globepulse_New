<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\Product;

class RFQMail extends Mailable
{
    public $rfq;
    public $buyer;
    public $supplier;
    public $type;

    public function __construct($rfq, $buyer, $supplier, $type)
    {
        $this->rfq = $rfq;
        $this->buyer = $buyer;
        $this->supplier = $supplier;
        $this->type = $type;
    }

    public function build()
    {
        $product = Product::find($this->rfq->product_id);

        return $this->subject(
                $this->type === 'supplier'
                    ? 'New RFQ Received on GlobPulse'
                    : 'Your RFQ Submitted Successfully'
            )
            ->view('emails.rfq-mail') // ✅ blade file
            ->with([
                'rfq' => $this->rfq,
                'buyer' => $this->buyer,
                'supplier' => $this->supplier,
                'type' => $this->type,
                'product' => $product
            ]);
    }
}