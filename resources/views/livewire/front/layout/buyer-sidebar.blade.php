<style>
   .buyer-sidebar{
background:#ffffff;
border:1px solid #e5e7eb;
border-radius:8px;
padding:20px;
height:100%;
box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.sidebar-title{
font-size:13px;
font-weight:700;
color:#6b7280;
margin-bottom:15px;
letter-spacing:1px;
}

.sidebar-menu .nav-link{
color:#374151;
padding:10px 12px;
border-radius:6px;
font-size:14px;
transition:all .2s ease;
}

.sidebar-menu .nav-link:hover{
background:#f3f4f6;
color:#2563eb;
}

.sidebar-menu .nav-link.active{
background:#2563eb;
color:#fff;
font-weight:600;
}
.sidebar-menu .nav-link i{
width:18px;
text-align:center;
}
.logout-link{
color:#ef4444;
}

.logout-link:hover{
background:#fee2e2;
color:#b91c1c;
}
</style>

<div class="buyer-sidebar">

<h6 class="sidebar-title">BUYER PANEL</h6>

<ul class="nav flex-column sidebar-menu">

<li class="nav-item">
<a class="nav-link active" href="{{ route('buyer.dashboard') }}">
<i class="fas fa-chart-line me-2"></i> Dashboard
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-plus-circle me-2"></i> Post RFQ
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-list me-2"></i> My RFQs
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-search me-2"></i> Find Suppliers
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-envelope me-2"></i> Messages
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-bookmark me-2"></i> Saved Suppliers
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-user-cog me-2"></i> Profile Settings
</a>
</li>

<li class="nav-item mt-3">
<a class="nav-link logout-link" wire:click="logout">
<i class="fas fa-sign-out-alt me-2"></i> Logout
</a>
</li>

</ul>

</div>