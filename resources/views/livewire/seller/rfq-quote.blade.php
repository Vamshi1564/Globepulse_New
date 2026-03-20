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
        <input type="text" wire:model="delivery_time" class="form-control">
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