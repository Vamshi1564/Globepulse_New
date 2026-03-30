<!DOCTYPE html>
<html>
<body style="margin:0;background:#f4f6f9;font-family:Arial,sans-serif">

@php
    $title = $type === 'supplier'
        ? 'New RFQ Received'
        : 'RFQ Submitted Successfully';

    $description = $type === 'supplier'
        ? 'You have received a new RFQ request.'
        : 'Your RFQ has been successfully submitted.';
@endphp

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0"
       style="background:#ffffff;border-radius:12px;margin:30px 0;overflow:hidden">

<!-- HEADER -->
<tr>
<td style="background:#0d6efd;padding:20px;text-align:center">
    <img src="https://www.globpulse.com/assets/img/logos/GFEPLUSE1.png" width="180">
</td>
</tr>

<!-- TITLE -->
<tr>
<td style="padding:25px">
    <h2 style="margin:0;color:#111">{{ $title }}</h2>
    <p style="color:#555;margin-top:5px">
        {{ $description }}
    </p>
</td>
</tr>

<!-- DETAILS -->
<tr>
<td style="padding:0 25px 20px">

<table width="100%" cellpadding="10" cellspacing="0"
       style="background:#f8fafc;border-radius:8px">

<tr>
<td><b>Product:</b></td>
<td>{{ $product->title ?? 'Product' }}</td>
</tr>

<tr>
<td><b>Quantity:</b></td>
<td>{{ $rfq->quantity }}</td>
</tr>

<tr>
<td><b>Target Price:</b></td>
<td>
    @if($rfq->target_price)
        ₹ {{ number_format($rfq->target_price, 2) }}
    @else
        Not specified
    @endif
</td>
</tr>

</table>

</td>
</tr>

<!-- MESSAGE -->
<tr>
<td style="padding:0 25px 20px">
    <h4 style="margin-bottom:5px">Requirement</h4>

    <div style="background:#f1f5f9;padding:12px;border-radius:8px;color:#333">
        {!! nl2br(e($rfq->message)) !!}
    </div>
</td>
</tr>

<!-- CTA -->
<tr>
<td style="padding:20px;text-align:center">

<a href="{{ url('/buyer/rfqs') }}"
   style="background:#0d6efd;color:#fff;padding:12px 25px;
          border-radius:6px;text-decoration:none;font-weight:bold;
          display:inline-block">
    View RFQ
</a>

</td>
</tr>

<!-- FOOTER -->
<tr>
<td style="text-align:center;padding:15px;font-size:12px;color:#888">
    © {{ date('Y') }} GlobPulse. All rights reserved.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>