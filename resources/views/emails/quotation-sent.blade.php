<h2>New Quotation Received</h2>

<p>Hello {{ $quotation->buyer->name ?? 'Buyer' }},</p>

<p>You have received a new quotation for your RFQ.</p>

<hr>

<p><strong>Product:</strong> {{ $quotation->rfq->product->title ?? '-' }}</p>
<p><strong>Price:</strong> ₹ {{ $quotation->price }}</p>
<p><strong>Delivery Time:</strong> {{ $quotation->delivery_time }}</p>
<p><strong>Payment Terms:</strong> {{ $quotation->payment_terms }}</p>

<hr>

<p><strong>Message:</strong></p>
<p>{{ $quotation->message }}</p>

<br>

<p>Login to your account to accept or reject the quotation.</p>