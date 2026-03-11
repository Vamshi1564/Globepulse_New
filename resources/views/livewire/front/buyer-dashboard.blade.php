<div>

<livewire:front.layout.header />

<div class="container-fluid">

<div class="row">

<!-- Sidebar -->
<div class="col-md-2 bg-white shadow-sm sidebar-fixed">

@include('livewire.front.layout.buyer-sidebar')

</div>


<!-- Main Content -->
<div class="col-md-10">

<div class="container py-4">

<h2 class="fw-bold mb-1">Buyer Dashboard</h2>

<p class="text-muted mb-4">
Logged in as <strong>{{ $buyerEmail }}</strong>
</p>

<div class="row g-4">

<!-- Total RFQ -->
<div class="col-md-3">
<div class="card shadow-sm border-0">
<div class="card-body">
<h6 class="text-muted">Total RFQs</h6>
<h3 class="fw-bold text-primary">{{ $totalRfq }}</h3>
</div>
</div>
</div>

<!-- Active Inquiries -->
<div class="col-md-3">
<div class="card shadow-sm border-0">
<div class="card-body">
<h6 class="text-muted">Active Inquiries</h6>
<h3 class="fw-bold text-success">{{ $activeInquiries }}</h3>
</div>
</div>
</div>

<!-- Saved Suppliers -->
<div class="col-md-3">
<div class="card shadow-sm border-0">
<div class="card-body">
<h6 class="text-muted">Saved Suppliers</h6>
<h3 class="fw-bold text-warning">{{ $savedSuppliers }}</h3>
</div>
</div>
</div>

<!-- Unread Messages -->
<div class="col-md-3">
<div class="card shadow-sm border-0">
<div class="card-body">
<h6 class="text-muted">Unread Messages</h6>
<h3 class="fw-bold text-danger">{{ $unreadMessages }}</h3>
</div>
</div>
</div>

</div>

</div>

</div>

</div>

</div>

<livewire:front.layout.footer />

</div>