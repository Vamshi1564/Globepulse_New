<style>
.buyer-sidebar{
background:#ffffff;
/* border:1px solid #e5e7eb;
border-radius:14px; */
/* padding:20px; */
/* box-shadow:0 10px 25px rgba(0,0,0,0.06); */
transition:.3s;
}

/* Sidebar Title */
.sidebar-title{
font-size:12px;
font-weight:700;
color:#9ca3af;
margin-bottom:18px;
letter-spacing:1.5px;
text-transform:uppercase;
}

/* Menu */
.sidebar-menu .nav-link{
display:flex;
align-items:center;
gap:10px;
color:#374151;
padding:12px 14px;
border-radius:10px;
font-size:14px;
font-weight:500;
transition:all .25s ease;
position:relative;
}

/* Icon container */
.sidebar-menu .nav-link i{
width:28px;
height:28px;
display:flex;
align-items:center;
justify-content:center;
border-radius:8px;
background:#f3f4f6;
font-size:13px;
transition:.25s;
}

/* Hover effect */
.sidebar-menu .nav-link:hover{
background:#f8fafc;
transform:translateX(4px);
color:#2563eb;
}

.sidebar-menu .nav-link:hover i{
background:#2563eb;
color:#fff;
}

/* Active menu */
.sidebar-menu .nav-link.active{
background:linear-gradient(135deg,#2563eb,#1e40af);
color:#fff;
font-weight:600;
box-shadow:0 6px 14px rgba(37,99,235,.3);
}

.sidebar-menu .nav-link.active i{
background:rgba(255,255,255,.2);
color:#fff;
}

/* Logout */
.logout-link{
color:#ef4444;
}

.logout-link:hover{
background:#fee2e2;
color:#b91c1c;
transform:translateX(4px);
}

.logout-link i{
background:#fee2e2;
}

/* Divider spacing */
.sidebar-menu .nav-item{
margin-bottom:4px;
}
</style>

<div class="buyer-sidebar">

<h6 class="sidebar-title">Buyer Panel</h6>

<ul class="nav flex-column sidebar-menu">

<li class="nav-item">
<a class="nav-link {{ request()->routeIs('buyer.dashboard') ? 'active' : '' }}"
   href="{{ route('buyer.dashboard') }}">
<i class="fas fa-chart-line"></i> Dashboard
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-plus-circle"></i> Post RFQ
</a>
</li>

<li class="nav-item">
<a class="nav-link {{ request()->routeIs('buyer.myrfqs') ? 'active' : '' }}"
   href="{{ route('buyer.myrfqs') }}">
<i class="fas fa-list"></i> My RFQs
</a>
</li>
<li class="nav-item">
<a class="nav-link {{ request()->routeIs('buyer.quotations') ? 'active' : '' }}"
   href="{{ route('buyer.quotations') }}">
<i class="fas fa-file-invoice-dollar"></i> Quotations
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-search"></i> Find Suppliers
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-envelope"></i> Messages
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-bookmark"></i> Saved Suppliers
</a>
</li>

<!-- <li class="nav-item">
<a class="nav-link" href="#">
<i class="fas fa-user-cog"></i> Profile Settings
</a>
</li> -->

<!-- <li class="nav-item mt-3">
<a class="nav-link logout-link" wire:click="logout">
<i class="fas fa-sign-out-alt"></i> Logout
</a>
</li> -->

</ul>

</div>