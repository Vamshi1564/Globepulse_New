<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RFQMail extends Mailable
{
    public function __construct(
        public $rfq,
        public $buyer,
        public $supplier,
        public $type // buyer or supplier
    ) {}

    public function build()
    {
        return $this->subject($this->type === 'supplier'
                ? 'New RFQ Received on GlobPulse'
                : 'Your RFQ Submitted Successfully')
            ->html($this->buildHtml());
    }

    private function buildHtml(): string
    {
        $year = date('Y');

        $product = \App\Models\Product::find($this->rfq->product_id);
        $productName = $product?->title ?? 'Product';
        $qty = $this->rfq->quantity;
        $price = $this->rfq->target_price ?? 'Not specified';
        $msg = nl2br(e($this->rfq->message));

        $title = $this->type === 'supplier'
            ? "New RFQ Received 🚀"
            : "RFQ Submitted Successfully ✅";

        return <<<HTML
<!DOCTYPE html>
<html>
<body style="background:#F1F5F9;font-family:Arial;padding:40px">

<table width="600" align="center" style="background:#fff;border-radius:16px;padding:30px">

<tr>
<td align="center" style="background:#222;padding:20px">
<img src="https://www.globpulse.com/assets/img/logos/GFEPLUSE1.png" width="220">
</td>
</tr>

<tr>
<td>

<h2>{$title}</h2>

<p><b>Product:</b> {$productName}</p>
<p><b>Quantity:</b> {$qty}</p>
<p><b>Target Price:</b> {$price}</p>

<hr>

<p><b>Requirement:</b></p>
<p>{$msg}</p>

<hr>

<p><b>Buyer:</b> {$this->buyer->name} ({$this->buyer->email})</p>

</td>
</tr>

<tr>
<td style="text-align:center;font-size:12px;color:#94A3B8">
© {$year} GlobPulse
</td>
</tr>

</table>

</body>
</html>
HTML;
    }
}