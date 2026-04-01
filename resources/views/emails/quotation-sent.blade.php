<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:20px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0"
       style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,0.05);">

    <!-- HEADER -->
    <tr>
        <td style="background:#198754;padding:20px;text-align:center;">
            <img src="https://www.globpulse.com/assets/img/logos/GFEPLUSE1.png" width="180">
        </td>
    </tr>

    <!-- TITLE -->
    <tr>
        <td style="padding:25px;">
            <h2 style="margin:0;color:#111;">New Quotation Received</h2>
            <p style="color:#555;margin-top:10px;">
                Hello {{ $quotation->buyer->name ?? 'Buyer' }},
                you have received a new quotation.
            </p>
        </td>
    </tr>

    <!-- DETAILS -->
    <tr>
        <td style="padding:0 25px 20px;">

            <table width="100%" cellpadding="10" cellspacing="0"
                   style="background:#f8fafc;border-radius:8px;">

                <tr>
                    <td><strong>Product:</strong></td>
                    <td>{{ $quotation->rfq->product->title ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Quantity:</strong></td>
                    <td>{{ $quotation->rfq->quantity ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Unit Price:</strong></td>
                    <td>₹ {{ number_format($quotation->price, 2) }}</td>
                </tr>

                <tr>
                    <td><strong>Delivery:</strong></td>
                    <td>{{ $quotation->delivery_time }}</td>
                </tr>

                <tr>
                    <td><strong>Payment:</strong></td>
                    <td>{{ $quotation->payment_terms }}</td>
                </tr>

            </table>

        </td>
    </tr>

    <!-- MESSAGE -->
    <tr>
        <td style="padding:0 25px 20px;">
            <h4 style="margin-bottom:10px;">Supplier Message</h4>
            <div style="background:#f1f5f9;padding:12px;border-radius:8px;">
                {{ $quotation->message }}
            </div>
        </td>
    </tr>

    <!-- CTA BUTTON -->
    <tr>
        <td style="text-align:center;padding:20px;">
            <a href="{{ url('/buyer/quotations') }}"
               style="background:#198754;color:#ffffff;
                      padding:12px 25px;border-radius:6px;
                      text-decoration:none;font-weight:bold;
                      display:inline-block;">
                View & Respond
            </a>
        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="text-align:center;font-size:12px;color:#888;padding:15px;">
            © {{ date('Y') }} GlobPulse. All rights reserved.
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>