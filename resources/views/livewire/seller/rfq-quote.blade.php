<div>

<livewire:seller.layout.header />

<div class="container py-4">

<h3 class="fw-bold mb-4">💰 Send Quotation</h3>

<div class="card shadow-sm border-0 rounded-4">
<div class="card-body">

<form wire:submit.prevent="submitQuote" class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Price</label>
        <input type="text" wire:model="price" class="form-control">
    </div>

    <div class="col-md-6">
    <label class="form-label">Delivery Time</label>

    <option value="">Select delivery time</option>
        <option value="1-3 days">1-3 days</option>
        <option value="3-5 days">3-5 days</option>
        <option value="7 days">7 days</option>
        <option value="10 days">10 days</option>
        <option value="14 days">14 days</option>
        <option value="21 days">21 days</option>
        <option value="30 days">30 days</option>
        <option value="45 days">45 days</option>
        <option value="60 days">60 days</option>
        <option value="90 days">90 days</option>
</div>

    <div class="col-md-6">
        <label class="form-label">Payment Terms</label>
        <input type="text" wire:model="payment_terms" class="form-control">
    </div>

    <div class="col-12">
        <label class="form-label">Message</label>
        <textarea wire:model="message" class="form-control"></textarea>
    </div>

    <div class="col-12 text-end">
        <button class="btn btn-success px-4">Send Quote</button>
    </div>

</form>

</div>
</div>

</div>

<livewire:seller.layout.footer />

</div>