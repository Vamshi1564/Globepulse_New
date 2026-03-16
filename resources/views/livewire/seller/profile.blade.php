<div>

<style>

.profile-progress{
position:relative;
width:120px;
height:120px;
margin:auto;
}

.profile-avatar{
width:100px;
height:100px;
border-radius:50%;
position:absolute;
top:10px;
left:10px;
z-index:2;
}

.progress-ring{
width:120px;
height:120px;
border-radius:50%;
}

.progress-text{
position:absolute;
bottom:-10px;
left:50%;
transform:translateX(-50%);
background:#fff;
padding:4px 10px;
border-radius:20px;
font-weight:600;
color:#f59e0b;
border:1px solid #eee;
}

.missing-card{
background:#f7e8d5;
border-radius:12px;
}

.missing-item{
display:flex;
justify-content:space-between;
padding:10px 0;
border-bottom:1px solid #eee;
}

</style>

<main class="main">

<div class="container pt-5">

<h2 class="mb-4">Seller Profile</h2>

<div class="row">

<!-- PROFILE SECTION -->

<div class="col-lg-8">

<div class="card shadow-sm border-0 mb-4">

<div class="card-body">

<div class="row align-items-center">

<!-- PROFILE IMAGE -->

<div class="col-md-3 text-center">

<div class="profile-progress">

<img src="https://ui-avatars.com/api/?name={{ $customer->name }}"
class="profile-avatar">

<div class="progress-ring"
style="background: conic-gradient(#f59e0b {{ $profilePercentage }}%, #e5e7eb 0);">
</div>

<div class="progress-text">
{{ $profilePercentage }}%
</div>

</div>

</div>

<!-- PROFILE DETAILS -->

<div class="col-md-9">

<h3>{{ $customer->name }}</h3>

<p class="text-muted">
Profile last updated {{ now()->format('d M Y') }}
</p>

<hr>

<div class="row">

<div class="col-md-6">
📍 {{ $customer->city ?? 'Not Added' }}
</div>

<div class="col-md-6">
📞 {{ $customer->phonenumber ?? 'Not Added' }}
</div>

<div class="col-md-6">
✉ {{ $customer->email }}
</div>

<div class="col-md-6">
🌐 {{ $customer->web_url ?? 'Not Added' }}
</div>

</div>

</div>

</div>

</div>

</div>

<!-- BUSINESS DETAILS -->

<div class="card shadow-sm border-0">

<div class="card-body">

<h5 class="mb-3">Business Details</h5>

<div class="row">

<div class="col-md-6 mb-2">
<strong>Company :</strong>
{{ $customer->company ?? 'N/A' }}
</div>

<div class="col-md-6 mb-2">
<strong>GST :</strong>
{{ $customer->gst_no ?? 'N/A' }}
</div>

<div class="col-md-6 mb-2">
<strong>Employees :</strong>
{{ $customer->employee_count ?? 'N/A' }}
</div>

<div class="col-md-6 mb-2">
<strong>Established :</strong>
{{ $customer->company_establish_date ?? 'N/A' }}
</div>

</div>

</div>

</div>

</div>

<!-- PROFILE COMPLETION -->

<div class="col-lg-4">

<div class="card missing-card shadow-sm border-0">

<div class="card-body">

<h5 class="mb-3">Complete your profile</h5>

@foreach($missingDetails as $detail)

<div class="missing-item">

<span>{{ $detail['label'] }}</span>

<span class="text-success">
+{{ $detail['percent'] }}%
</span>

</div>

@endforeach

@if(count($missingDetails) > 0)

<button class="btn btn-danger w-100 mt-3">
Add {{ count($missingDetails) }} Missing Details
</button>

@endif

</div>

</div>

</div>

</div>

</div>

</main>

</div>