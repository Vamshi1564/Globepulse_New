<style>

/* Dashboard Layout */

.dashboard-layout{
margin-top:20px;
background:#f3f6fb;
}

/* Sidebar */

.dashboard-sidebar{
background:#ffffff;
border-right:1px solid #e5e7eb;
min-height:100vh;
padding:22px;
}

/* Main Content */

.dashboard-content{
background:#f3f6fb;
min-height:100vh;
padding-top:25px;
}

/* Page Title */

.dashboard-title{
font-size:26px;
font-weight:700;
color:#111827;
}

.dashboard-subtitle{
font-size:14px;
color:#6b7280;
}

/* Cards */

.dashboard-card{
border:none;
border-radius:14px;
padding:18px;
background:#ffffff;
box-shadow:0 6px 20px rgba(0,0,0,0.05);
transition:all .25s ease;
position:relative;
overflow:hidden;
}

.dashboard-card:hover{
transform:translateY(-6px);
box-shadow:0 15px 35px rgba(0,0,0,0.12);
}

/* Icon Circle */

.card-icon{
width:42px;
height:42px;
border-radius:10px;
display:flex;
align-items:center;
justify-content:center;
font-size:18px;
margin-bottom:10px;
}

/* Icon Colors */

.icon-blue{
background:#e0ecff;
color:#2563eb;
}

.icon-green{
background:#dcfce7;
color:#16a34a;
}

.icon-orange{
background:#fff7ed;
color:#ea580c;
}

.icon-red{
background:#fee2e2;
color:#dc2626;
}

/* Card Numbers */

.card-number{
font-size:26px;
font-weight:700;
margin-top:5px;
}

/* Card Label */

.card-label{
font-size:13px;
color:#6b7280;
}

/* Dashboard Welcome Box */

.dashboard-welcome{
background:linear-gradient(135deg,#2563eb,#1e40af);
color:#fff;
padding:20px;
border-radius:14px;
margin-bottom:25px;
box-shadow:0 10px 25px rgba(37,99,235,.35);
}

</style>

<div>

<livewire:front.layout.header />

<div class="container-fluid dashboard-layout">

<div class="row">

<!-- Sidebar -->
<div class="col-md-2 dashboard-sidebar">

@include('livewire.front.layout.buyer-sidebar')

</div>


<!-- Main Content -->
<div class="col-md-10 dashboard-content">

<div class="container py-4">

<!-- Welcome Banner -->
<div class="dashboard-welcome">

<h3 class="mb-1 fw-bold">
Welcome Back {{ $buyerFullName }} 👋
</h3>

<p class="mb-0">
Logged in as <strong>{{ $buyerEmail }}</strong>
</p>

</div>


<div class="row g-4">

<!-- Total RFQ -->
<div class="col-md-3">

<div class="dashboard-card">

<div class="card-icon icon-blue">
<i class="fas fa-file-alt"></i>
</div>

<div class="card-label">Total RFQs</div>

<div class="card-number text-primary">
{{ $totalRfq }}
</div>

</div>

</div>


<!-- Active Inquiries -->

<div class="col-md-3">

<div class="dashboard-card">

<div class="card-icon icon-green">
<i class="fas fa-bolt"></i>
</div>

<div class="card-label">Active Inquiries</div>

<div class="card-number text-success">
{{ $activeInquiries }}
</div>

</div>

</div>


<!-- Saved Suppliers -->

<div class="col-md-3">

<div class="dashboard-card">

<div class="card-icon icon-orange">
<i class="fas fa-bookmark"></i>
</div>

<div class="card-label">Saved Suppliers</div>

<div class="card-number text-warning">
{{ $savedSuppliers }}
</div>

</div>

</div>


<!-- Messages -->

<div class="col-md-3">

<div class="dashboard-card">

<div class="card-icon icon-red">
<i class="fas fa-envelope"></i>
</div>

<div class="card-label">Unread Messages</div>

<div class="card-number text-danger">
{{ $unreadMessages }}
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