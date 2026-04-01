<div>
{{-- FILE: resources/views/livewire/seller/my-listings.blade.php --}}
<livewire:seller.layout.header />

<style>
/* ── Page ── */
.ml-wrap{padding:1.25rem;}

/* ── Top bar ── */
.ml-topbar{background:#fff;border-radius:14px;border:1px solid #e8ecf4;padding:16px 20px;
  display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.8rem;margin-bottom:1.25rem;
  box-shadow:0 1px 8px rgba(0,0,0,.04);}
.ml-title{font-size:1.1rem;font-weight:800;color:#0f172a;margin:0;display:flex;align-items:center;gap:.5rem;}
.ml-add-btns{display:flex;gap:.6rem;flex-wrap:wrap;}
.btn-add-product{background:#1d4ed8;color:#fff;text-decoration:none;padding:.5rem 1.1rem;border-radius:10px;
  font-size:.82rem;font-weight:700;display:flex;align-items:center;gap:.35rem;box-shadow:0 3px 12px rgba(29,78,216,.25);transition:all .15s;}
.btn-add-product:hover{background:#1e40af;color:#fff;}
.btn-add-service{background:#7c3aed;color:#fff;text-decoration:none;padding:.5rem 1.1rem;border-radius:10px;
  font-size:.82rem;font-weight:700;display:flex;align-items:center;gap:.35rem;box-shadow:0 3px 12px rgba(124,58,237,.25);transition:all .15s;}
.btn-add-service:hover{background:#6d28d9;color:#fff;}

/* ── Tabs ── */
.ml-tabs{background:#fff;border-radius:12px;border:1px solid #e8ecf4;padding:.6rem .8rem;
  display:flex;gap:.35rem;flex-wrap:wrap;margin-bottom:1.25rem;box-shadow:0 1px 6px rgba(0,0,0,.03);}
.ml-tab{padding:.38rem 1rem;border-radius:20px;border:1.5px solid transparent;font-size:.78rem;
  font-weight:700;cursor:pointer;transition:all .15s;color:#475569;background:#f8fafc;display:flex;align-items:center;gap:.3rem;}
.ml-tab:hover:not(.active){background:#f1f5f9;border-color:#e2e8f0;}
.ml-tab.active{background:#0f172a;color:#fff;border-color:#0f172a;}
.ml-tab.tab-product.active{background:#1d4ed8;border-color:#1d4ed8;}
.ml-tab.tab-service.active{background:#7c3aed;border-color:#7c3aed;}
.ml-tab-count{background:rgba(0,0,0,.12);border-radius:20px;padding:0 7px;font-size:.68rem;min-width:20px;text-align:center;}
.ml-tab.active .ml-tab-count{background:rgba(255,255,255,.25);}

/* ── Status filter strip ── */
.ml-status-row{display:flex;gap:.35rem;flex-wrap:wrap;margin-bottom:1.25rem;align-items:center;}
.ml-status-pill{padding:.3rem .8rem;border-radius:20px;border:1.5px solid #e2e8f0;font-size:.75rem;
  font-weight:700;cursor:pointer;transition:all .15s;color:#475569;background:#f8fafc;}
.ml-status-pill:hover:not(.active){background:#f1f5f9;}
.ml-status-pill.active{background:#0f172a;color:#fff;border-color:#0f172a;}
.ml-search{border:1.5px solid #e2e8f0;border-radius:10px;padding:.38rem .85rem .38rem 2.1rem;
  font-size:.82rem;min-width:220px;outline:none;background:#f8fafc;transition:border .2s;}
.ml-search:focus{border-color:#1d4ed8;background:#fff;box-shadow:0 0 0 3px rgba(29,78,216,.08);}
.ml-search-wrap{position:relative;}
.ml-search-icon{position:absolute;left:.7rem;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.8rem;}

/* ── Table ── */
.ml-table-wrap{background:#fff;border-radius:14px;border:1px solid #e8ecf4;overflow:hidden;
  box-shadow:0 2px 12px rgba(0,0,0,.04);}
.ml-table{width:100%;border-collapse:collapse;font-size:.83rem;}
.ml-table thead{background:#f8fafc;}
.ml-table th{padding:.75rem 1rem;color:#64748b;font-weight:700;font-size:.73rem;text-transform:uppercase;
  letter-spacing:.04em;border-bottom:2px solid #e8ecf4;text-align:left;white-space:nowrap;}
.ml-table td{padding:.85rem 1rem;border-bottom:1px solid #f1f5f9;vertical-align:middle;color:#334155;}
.ml-table tbody tr:last-child td{border-bottom:none;}
.ml-table tbody tr:hover td{background:#fafbfe;}

/* ── Listing thumb ── */
.ml-thumb{width:52px;height:52px;border-radius:10px;object-fit:cover;border:1.5px solid #e5e9f2;flex-shrink:0;}
.ml-thumb-placeholder{width:52px;height:52px;border-radius:10px;border:1.5px solid #e5e9f2;
  display:flex;align-items:center;justify-content:center;background:#f8fafc;font-size:1.2rem;}

/* ── Type badge ── */
.ml-type-badge{font-size:.68rem;font-weight:700;padding:2px 8px;border-radius:20px;display:inline-block;white-space:nowrap;}
.type-product{background:#dbeafe;color:#1e40af;}
.type-service{background:#ede9fe;color:#6d28d9;}

/* ── Status badge ── */
.ml-status{font-size:.7rem;font-weight:700;padding:3px 10px;border-radius:20px;white-space:nowrap;}
.st-approved{background:#d1fae5;color:#065f46;}
.st-pending {background:#fef3c7;color:#92400e;}
.st-rejected{background:#fee2e2;color:#991b1b;}
.st-inactive{background:#f1f5f9;color:#475569;}
.st-draft   {background:#f0f4ff;color:#4338ca;border:1px dashed #a5b4fc;}

/* ── Action buttons ── */
/* ── Action buttons ── */
.btn-edit,
.btn-publish-now,
.btn-del,
.btn-view-detail {
    font-size: .74rem;
    padding: 4px 7px;
    border-radius: 8px;
    border: 1.5px solid;
    font-weight: 700;
    cursor: pointer;
    transition: all .15s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 25px;
    height: 29px;
    white-space: nowrap;
}

.btn-edit {
    border-color: #1d4ed8;
    background: #eff6ff;
    color: #1d4ed8;
}

.btn-edit:hover {
    background: #1d4ed8;
    color: #fff;
}

.btn-publish-now {
    border-color: #059669;
    background: #f0fdf4;
    color: #059669;
}

.btn-publish-now:hover {
    background: #059669;
    color: #fff;
}

.btn-del {
    border-color: #ef4444;
    background: #fff;
    color: #ef4444;
}

.btn-del:hover {
    background: #fee2e2;
    color: #ef4444;
}

.btn-view-detail {
    border-color: #6d28d9;
    background: #f5f3ff;
    color: #6d28d9;
}

.btn-view-detail:hover {
    background: #6d28d9;
    color: #fff;
}

/* Make icons consistent */
.btn-edit i,
.btn-publish-now i,
.btn-del i,
.btn-view-detail i {
    font-size: .82rem;
}
/* .btn-edit{font-size:.74rem;padding:5px 12px;border-radius:8px;border:1.5px solid #1d4ed8;
  background:#eff6ff;color:#1d4ed8;font-weight:700;cursor:pointer;text-decoration:none;transition:all .15s;display:inline-block;}
.btn-edit:hover{background:#1d4ed8;color:#fff;}
.btn-publish-now{font-size:.74rem;padding:5px 12px;border-radius:8px;
  border:1.5px solid #059669;background:#f0fdf4;color:#059669;font-weight:700;cursor:pointer;
  transition:all .15s;display:inline-block;}
.btn-publish-now:hover{background:#059669;color:#fff;}
.btn-del{font-size:.74rem;padding:5px 12px;border-radius:8px;border:1.5px solid #ef4444;
  background:#fff;color:#ef4444;font-weight:700;cursor:pointer;transition:all .15s;display:inline-block;}
.btn-del:hover{background:#fee2e2;} */

/* ── Empty state ── */
.ml-empty{text-align:center;padding:4rem 2rem;}

/* ── Pagination ── */
.ml-pagination{padding:1rem 1.25rem;background:#f8fafc;border-top:1px solid #e8ecf4;
  display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.5rem;}
.ml-pag-info{font-size:.8rem;color:#64748b;font-weight:500;}
.ml-pagination .pagination{margin:0;}
.ml-pagination .page-link{border-radius:8px!important;border:1.5px solid #e2e8f0;color:#334155;
  font-size:.8rem;font-weight:600;padding:.35rem .7rem;margin:0 2px;transition:all .15s;}
.ml-pagination .page-link:hover{background:#e8f0fe;border-color:#1d4ed8;color:#1d4ed8;}
.ml-pagination .page-item.active .page-link{background:#0f172a;border-color:#0f172a;color:#fff;}
.ml-pagination .page-item.disabled .page-link{opacity:.4;}

/* ── Alert ── */
.ml-alert{border-radius:10px;padding:12px 16px;margin-bottom:1rem;font-size:.84rem;font-weight:600;display:flex;align-items:center;gap:8px;}
.ml-alert.success{background:#d1fae5;border:1.5px solid #6ee7b7;color:#065f46;}

/* ── View detail button ── */
.btn-view-detail{font-size:.74rem;padding:5px 10px;border-radius:8px;border:1.5px solid #6d28d9;
  background:#f5f3ff;color:#6d28d9;font-weight:700;cursor:pointer;transition:all .15s;display:inline-block;}
.btn-view-detail:hover{background:#6d28d9;color:#fff;}

/* ── Detail modal ── */
.ld-overlay{position:fixed;inset:0;z-index:1040;background:rgba(15,23,42,.5);backdrop-filter:blur(2px);opacity:0;pointer-events:none;transition:opacity .25s;}
.ld-overlay.open{opacity:1;pointer-events:all;}
.ld-drawer{position:fixed;top:0;right:0;bottom:0;width:min(480px,100vw);background:#fff;z-index:1050;
  display:flex;flex-direction:column;transform:translateX(100%);transition:transform .28s cubic-bezier(.4,0,.2,1);
  box-shadow:-6px 0 40px rgba(0,0,0,.15);}
.ld-drawer.open{transform:translateX(0);}
.ld-header{padding:1.1rem 1.3rem;border-bottom:1px solid #e8ecf4;background:#f8fafc;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;}
.ld-body{flex:1;overflow-y:auto;padding:1.25rem;}
.ld-img{width:100%;height:220px;object-fit:contain;border-radius:12px;border:1.5px solid #e8ecf4;background:#f8fafc;margin-bottom:1rem;}
.ld-img-placeholder{width:100%;height:180px;border-radius:12px;border:1.5px solid #e8ecf4;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-size:3rem;margin-bottom:1rem;}
.ld-field{margin-bottom:.85rem;}
.ld-field label{font-size:.7rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;}
.ld-field .val{font-size:.88rem;font-weight:600;color:#1e293b;}
</style>

<div class="ml-wrap">

  @if(session('message'))
  <div id="ml-toast" style="position:fixed;top:20px;right:20px;z-index:99999;background:#059669;color:#fff;padding:14px 20px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.15);display:flex;align-items:center;gap:10px;font-size:.88rem;font-weight:600;min-width:300px;max-width:420px;animation:slideIn .3s ease;">
    <i class="bi bi-check-circle-fill" style="font-size:1.1rem;flex-shrink:0;"></i>
    <span>{{ session('message') }}</span>
    <button onclick="document.getElementById('ml-toast').remove()" style="margin-left:auto;background:none;border:none;color:#fff;font-size:1.1rem;cursor:pointer;padding:0 0 0 8px;opacity:.8;">×</button>
  </div>
  <style>
    @keyframes slideIn { from{opacity:0;transform:translateX(40px)} to{opacity:1;transform:translateX(0)} }
  </style>
  <script>
    setTimeout(function(){ var t=document.getElementById('ml-toast'); if(t) t.style.animation='slideIn .3s ease reverse'; setTimeout(function(){ if(t) t.remove(); },300); }, 4000);
  </script>
  @endif

  {{-- ── TOP BAR ── --}}
  <div class="ml-topbar">
    <div>
      <h4 class="ml-title">
        <span style="background:#f0f4ff;border-radius:9px;padding:5px 10px;">
          <i class="bi bi-grid-1x2-fill" style="color:#1d4ed8;"></i>
        </span>
        My Listings
      </h4>
      <div style="font-size:.76rem;color:#94a3b8;margin-top:3px;">
        {{ $counts['all'] }} total &nbsp;·&nbsp;
        {{ $counts['products'] }} products &nbsp;·&nbsp;
        {{ $counts['services'] }} services
      </div>
    </div>
    <div class="ml-add-btns">
      <a href="{{ route('product_add') }}" class="btn-add-product">
        <i class="bi bi-plus-lg"></i> Add Product
      </a>
      <a href="{{ route('service_add') }}" class="btn-add-service">
        <i class="bi bi-plus-lg"></i> Add Service
      </a>
    </div>
  </div>

  {{-- ── TYPE TABS ── --}}
  <div class="ml-tabs">
    <button class="ml-tab {{ $activeTab==='all' ? 'active' : '' }}"
            wire:click="$set('activeTab','all')">
      <i class="bi bi-grid-fill" style="font-size:.75rem;"></i> All Listings
      <span class="ml-tab-count">{{ $counts['all'] }}</span>
    </button>
    <button class="ml-tab tab-product {{ $activeTab==='products' ? 'active' : '' }}"
            wire:click="$set('activeTab','products')">
      <i class="bi bi-box-seam" style="font-size:.75rem;"></i> Products
      <span class="ml-tab-count">{{ $counts['products'] }}</span>
    </button>
    <button class="ml-tab tab-service {{ $activeTab==='services' ? 'active' : '' }}"
            wire:click="$set('activeTab','services')">
      <i class="bi bi-briefcase" style="font-size:.75rem;"></i> Services
      <span class="ml-tab-count">{{ $counts['services'] }}</span>
    </button>
  </div>

  {{-- ── STATUS FILTER + SEARCH ── --}}
  <div class="ml-status-row">
    @foreach(['all'=>'All','pending'=>'⏳ Pending','approved'=>'✅ Approved','rejected'=>'❌ Rejected'] as $val=>$label)
    <button class="ml-status-pill {{ $statusFilter===$val ? 'active' : '' }}"
            wire:click="$set('statusFilter','{{ $val }}')">
      {{ $label }}
      @if($val==='pending')
        ({{ $activeTab==='services' ? $counts['s_pending'] : ($activeTab==='products' ? $counts['p_pending'] : $counts['p_pending']+$counts['s_pending']) }})
      @elseif($val==='approved')
        ({{ $activeTab==='services' ? $counts['s_approved'] : ($activeTab==='products' ? $counts['p_approved'] : $counts['p_approved']+$counts['s_approved']) }})
      @elseif($val==='rejected')
        ({{ $activeTab==='services' ? $counts['s_rejected'] : ($activeTab==='products' ? $counts['p_rejected'] : $counts['p_rejected']+$counts['s_rejected']) }})
      @endif
    </button>
    @endforeach

    <div style="margin-left:auto;" class="ml-search-wrap">
      <i class="bi bi-search ml-search-icon"></i>
      <input wire:model.live.debounce.400ms="search" class="ml-search"
             placeholder="Search listings...">
    </div>
  </div>

  {{-- ── TABLE ── --}}
  <div class="ml-table-wrap">
    <div style="overflow-x:auto;">
    <table class="ml-table">
      <thead>
        <tr>
          <th style="width:40px;">#</th>
          <th style="width:60px;">Image</th>
          <th>Title</th>
          <th>Type</th>
          <th>Price / Rate</th>
          <th>Details</th>
          <th>Status</th>
          <th>Added</th>
          <th style="width:120px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        {{-- JS Map to hold item data — avoids ALL HTML attribute escaping issues --}}
        <script>window._listingItems = window._listingItems || {};</script>
        @forelse($listings as $item)
        @php
            $rowKey = $item['type'] . '_' . $item['id'];
            $awsBase = config('app.pub_aws_url', '');
            $imgPath = $item['image'] ?? null;
            $fullImgUrl = $imgPath
                ? (str_starts_with($imgPath,'http') ? $imgPath
                    : ($awsBase ? rtrim($awsBase,'/') . '/' . $imgPath : asset('storage/' . $imgPath)))
                : null;
            $itemData = json_encode([
                'id'             => $item['id'],
                'type'           => $item['type'],
                'title'          => $item['title'] ?? '',
                'brand_name'     => $item['brand_name'] ?? '',
                'description'    => $item['description'] ?? '',
                'image'          => $fullImgUrl,
                'status'         => $item['status'],
                'price'          => $item['price'] ?? '—',
                'meta'           => $item['meta'] ?? '',
                'keywords'       => $item['keywords'] ?? '',
                'certifications' => $item['certifications'] ?? '',
                'lead_time'      => $item['lead_time'] ?? '',
                'supply_ability' => $item['supply_ability'] ?? '',
                'country_of_origin' => $item['country_of_origin'] ?? '',
                'rejection_reason'  => $item['rejection_reason'] ?? '',
                'edit_route'     => $item['edit_route'] ?? '#',
                'created_at'     => $item['created_at']
                    ? \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d')
                    : null,
            ], JSON_UNESCAPED_UNICODE);
        @endphp
        <script>window._listingItems['{{ $rowKey }}'] = {!! $itemData !!};</script>
        <tr wire:key="{{ $rowKey }}">
          <td style="color:#94a3b8;font-size:.75rem;font-weight:600;">
            {{ $listings->firstItem() + $loop->index }}
          </td>

          <td>
            @if($fullImgUrl)
              <img src="{{ $fullImgUrl }}" class="ml-thumb"
                   onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
              <div class="ml-thumb-placeholder" style="display:none;">
                {{ $item['type'] === 'product' ? '📦' : '🛠️' }}
              </div>
            @else
              <div class="ml-thumb-placeholder">
                {{ $item['type'] === 'product' ? '📦' : '🛠️' }}
              </div>
            @endif
          </td>

          <td>
            <div style="font-weight:700;color:#0f172a;font-size:.86rem;line-height:1.3;">
              {{ Str::limit($item['title'], 55) }}
            </div>
          </td>

          <td>
            <span class="ml-type-badge {{ $item['type'] === 'product' ? 'type-product' : 'type-service' }}">
              {{ $item['type'] === 'product' ? '📦 Product' : '🛠️ Service' }}
            </span>
          </td>

          <td>
            <span style="font-weight:700;color:#059669;font-size:.84rem;">{{ $item['price'] }}</span>
          </td>

          <td style="font-size:.76rem;color:#64748b;max-width:160px;">
            {{ $item['meta'] }}
          </td>

          <td>
            @php
              $statusClass = match($item['status']) {
                'approved' => 'st-approved',
                'rejected' => 'st-rejected',
                'draft'    => 'st-draft',
                'inactive' => 'st-inactive',
                default    => 'st-pending',
              };
              $statusLabel = match($item['status']) {
                'approved' => '✅ Approved',
                'rejected' => '❌ Rejected',
                'draft'    => '📝 Draft',
                'inactive' => '⏸ Inactive',
                default    => '⏳ Pending',
              };
            @endphp
            <span class="ml-status {{ $statusClass }}">{{ $statusLabel }}</span>
          </td>

          <td style="font-size:.76rem;color:#94a3b8;white-space:nowrap;">
            {{ $item['created_at'] ? \Carbon\Carbon::parse($item['created_at'])->format('d M Y') : '—' }}
          </td>

          <td>
            <div style="display:flex; gap:6px; align-items:center; flex-wrap:wrap; justify-content:flex-end;">
                
                {{-- Publish / Resubmit Button for Products --}}
                @if($item['type'] === 'product' && in_array($item['status'], ['draft', 'pending', 'rejected']))
                    @if($item['status'] === 'draft')
                        <button class="btn-publish-now"
                            wire:click="publishProduct({{ $item['id'] }})"
                            wire:confirm="Submit this product for admin review?"
                            title="Submit for admin review">
                            <i class="bi bi-send-fill" style="font-size:.75rem;"></i> Publish
                        </button>
                    @elseif($item['status'] === 'rejected')
                        <button class="btn-publish-now" 
                            style="border-color:#f59e0b; background:#fffbeb; color:#92400e;"
                            wire:click="publishProduct({{ $item['id'] }})"
                            wire:confirm="Re-submit this product for review?"
                            title="Re-submit for review">
                            <i class="bi bi-arrow-clockwise" style="font-size:.75rem;"></i> Resubmit
                        </button>
                    @elseif($item['status'] === 'pending')
                        <span class="ml-status st-pending" style="font-size:.72rem; padding:4px 10px;">
                            ⏳ Under Review
                        </span>
                    @endif
                @endif

                {{-- View Detail Button --}}
                <button class="btn-view-detail"
                    onclick="openListingDetail('{{ $rowKey }}')"
                    title="View full details">
                    <i class="bi bi-eye" style="font-size:.78rem;"></i>
                </button>

                {{-- Edit Button — disabled for approved listings --}}
                @if($item['status'] === 'approved')
                    <span class="btn-edit"
                        title="Approved listings cannot be edited"
                        style="opacity:.35;cursor:not-allowed;pointer-events:none;">
                        <i class="bi bi-pencil" style="font-size:.78rem;"></i>
                    </span>
                @else
                    <a href="{{ $item['edit_route'] }}" class="btn-edit" title="Edit listing">
                        <i class="bi bi-pencil" style="font-size:.78rem;"></i>
                    </a>
                @endif

                {{-- Delete Button --}}
                @if($item['type'] === 'product')
                    <button class="btn-del"
                        wire:click="deleteProduct({{ $item['id'] }})"
                        onclick="return confirm('Delete this product? Permanently remove this listing?')"
                        title="Delete product">
                        <i class="bi bi-trash" style="font-size:.78rem;"></i>
                    </button>
                @else
                    <button class="btn-del"
                        wire:click="deleteService({{ $item['id'] }})"
                        onclick="return confirm('Delete this service? Permanently remove this listing?')"
                        title="Delete service">
                        <i class="bi bi-trash" style="font-size:.78rem;"></i>
                    </button>
                @endif
            </div>
        </td>
        </tr>
        @empty
        <tr>
          <td colspan="9">
            <div class="ml-empty">
              <i class="bi bi-inbox" style="font-size:3rem;color:#e2e8f0;display:block;margin-bottom:12px;"></i>
              <div style="font-weight:700;color:#374151;margin-bottom:6px;">
                No {{ $activeTab === 'all' ? 'listings' : $activeTab }} found
                @if($search) matching "{{ $search }}" @endif
              </div>
              <div style="font-size:.84rem;color:#94a3b8;margin-bottom:18px;">
                Start adding products or services to reach buyers in 180+ countries.
              </div>
              <div style="display:flex;gap:.6rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('product_add') }}" class="btn-add-product" style="text-decoration:none;">
                  <i class="bi bi-plus-lg"></i> Add Product
                </a>
                <a href="{{ route('service_add') }}" class="btn-add-service" style="text-decoration:none;">
                  <i class="bi bi-plus-lg"></i> Add Service
                </a>
              </div>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
    </div>

    {{-- Pagination --}}
    @if($listings->hasPages() || $listings->total() > 0)
    <div class="ml-pagination">
      <span class="ml-pag-info">
        Showing <strong>{{ $listings->firstItem() }}</strong>–<strong>{{ $listings->lastItem() }}</strong>
        of <strong>{{ $listings->total() }}</strong> listings
      </span>
      {{ $listings->links() }}
    </div>
    @endif
  </div>

{{-- ── LISTING DETAIL DRAWER ── --}}
<div wire:ignore>
<div class="ld-overlay" id="ld-overlay" onclick="closeListingDetail()"></div>
<div class="ld-drawer" id="ld-drawer">
  <div class="ld-header">
    <div style="font-weight:800;font-size:.95rem;color:#0f172a;" id="ld-title">Product Details</div>
    <button onclick="closeListingDetail()" style="background:none;border:none;font-size:1.2rem;cursor:pointer;color:#64748b;padding:4px 8px;border-radius:7px;transition:background .15s;" onmouseover="this.style.background='#fee2e2';this.style.color='#dc2626'" onmouseout="this.style.background='none';this.style.color='#64748b'">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>
  <div class="ld-body" id="ld-body">
    {{-- Filled by JS --}}
  </div>
</div>

<script>
function openListingDetail(rowKey) {
    var item;
    try {
        item = window._listingItems[rowKey];
        if (!item) throw new Error('Item not found: ' + rowKey);
    } catch(e) {
        console.error('View drawer error:', e);
        alert('Could not load item details. Check console.');
        return;
    }

    // ── Title ──────────────────────────────────────────────
    document.getElementById('ld-title').textContent =
        item.type === 'product' ? 'Product Details' : 'Service Details';

    // ── Build image ────────────────────────────────────────
    var awsBase = '{{ rtrim(config("app.pub_aws_url",""), "/") }}';
    var storageBase = '{{ asset("storage") }}';
    var imgSrc = '';
    if (item.image) {
        if (item.image.startsWith('http')) {
            imgSrc = item.image;
        } else if (awsBase && item.image.startsWith('uploads/')) {
            imgSrc = awsBase + '/' + item.image;
        } else {
            imgSrc = storageBase + '/' + item.image;
        }
    }

    // ── Status badge ───────────────────────────────────────
    var statusMap = {
        approved : {bg:'#d1fae5', color:'#065f46', icon:'check-circle-fill',  label:'Approved'},
        pending  : {bg:'#fef3c7', color:'#92400e', icon:'hourglass-split',     label:'Under Review'},
        rejected : {bg:'#fee2e2', color:'#991b1b', icon:'x-circle-fill',       label:'Rejected'},
        draft    : {bg:'#f0f4ff', color:'#4338ca', icon:'pencil-square',       label:'Draft'},
    };
    var st = statusMap[item.status] || statusMap['pending'];

    // ── Build body using DOM (no innerHTML string quoting issues) ──
    var body = document.getElementById('ld-body');
    body.innerHTML = '';

    // Image
    var imgWrap = document.createElement('div');
    imgWrap.style.cssText = 'margin-bottom:1rem;border-radius:12px;overflow:hidden;border:1.5px solid #e8ecf4;background:#f8fafc;display:flex;align-items:center;justify-content:center;min-height:140px;';
    if (imgSrc) {
        var img = document.createElement('img');
        img.src = imgSrc;
        img.style.cssText = 'width:100%;max-height:220px;object-fit:contain;';
        img.onerror = function() {
            this.style.display = 'none';
            var ph = document.createElement('div');
            ph.style.cssText = 'font-size:3rem;padding:2rem;';
            ph.textContent = item.type === 'product' ? '📦' : '🛠️';
            imgWrap.appendChild(ph);
        };
        imgWrap.appendChild(img);
    } else {
        var ph = document.createElement('div');
        ph.style.cssText = 'font-size:3rem;padding:2rem;';
        ph.textContent = item.type === 'product' ? '📦' : '🛠️';
        imgWrap.appendChild(ph);
    }
    body.appendChild(imgWrap);

    // Status banner
    if (item.status === 'pending') {
        var banner = mkBanner('#fef3c7','#92400e','hourglass-split','Under admin review — will go live once approved.');
        body.appendChild(banner);
    } else if (item.status === 'rejected') {
        var banner = mkBanner('#fee2e2','#991b1b','x-circle','Rejected. Edit the listing and resubmit for review.');
        body.appendChild(banner);
    } else if (item.status === 'approved') {
        var banner = mkBanner('#d1fae5','#065f46','check-circle-fill','Live — visible to buyers worldwide.');
        body.appendChild(banner);
    } else if (item.status === 'draft') {
        var banner = mkBanner('#f0f4ff','#4338ca','pencil-square','Draft — click Publish to submit for admin review.');
        body.appendChild(banner);
    }

    // Info card
    var card = document.createElement('div');
    card.style.cssText = 'background:#f8fafc;border-radius:10px;padding:1rem;margin-bottom:1rem;border:1px solid #e8ecf4;';

    // Title
    addField(card, 'Title', item.title || '—', 'font-size:.95rem;font-weight:700;color:#0f172a;');

    // Brand (products only)
    if (item.brand_name) {
        var brandWrap = document.createElement('div');
        brandWrap.style.cssText = 'margin-bottom:.5rem;';
        brandWrap.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">Brand</span>' +
            '<span style="font-size:.78rem;font-weight:700;background:#fef3c7;color:#92400e;padding:2px 10px;border-radius:20px;display:inline-block;">' + item.brand_name + '</span>';
        card.appendChild(brandWrap);
    }

    // Description
    if (item.description) {
        var descDiv = document.createElement('div');
        descDiv.style.cssText = 'margin-bottom:.75rem;';
        descDiv.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:4px;">Description</span>' +
            '<div style="font-size:.82rem;color:#334155;line-height:1.6;max-height:100px;overflow-y:auto;background:#fff;border-radius:7px;padding:.5rem .75rem;border:1px solid #e8ecf4;">' + item.description + '</div>';
        card.appendChild(descDiv);
    }

    var grid = document.createElement('div');
    grid.style.cssText = 'display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:.25rem;';

    // Type
    var typeEl = document.createElement('div');
    typeEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">Type</span>' +
        '<span style="font-size:.82rem;font-weight:600;color:#1e293b;">' + (item.type === 'product' ? '📦 Product' : '🛠️ Service') + '</span>';
    grid.appendChild(typeEl);

    // Status
    var stEl = document.createElement('div');
    stEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">Status</span>' +
        '<span style="font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:20px;background:' + st.bg + ';color:' + st.color + ';">' + st.label + '</span>';
    grid.appendChild(stEl);

    // Price
    var prEl = document.createElement('div');
    prEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">Price / Rate</span>' +
        '<span style="font-size:.9rem;font-weight:700;color:#059669;">' + (item.price || '—') + '</span>';
    grid.appendChild(prEl);

    // Details (MOQ / Service Type)
    var dtEl = document.createElement('div');
    dtEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">Details</span>' +
        '<span style="font-size:.82rem;font-weight:600;color:#1e293b;">' + (item.meta || '—') + '</span>';
    grid.appendChild(dtEl);

    // Lead Time / Turnaround
    if (item.lead_time) {
        var ltEl = document.createElement('div');
        ltEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">' +
            (item.type === 'product' ? 'Lead Time' : 'Turnaround') + '</span>' +
            '<span style="font-size:.82rem;font-weight:600;color:#1e293b;">⏱ ' + item.lead_time + '</span>';
        grid.appendChild(ltEl);
    }

    // Supply Ability / Service Area
    if (item.supply_ability) {
        var saEl = document.createElement('div');
        saEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">' +
            (item.type === 'product' ? 'Supply / Month' : 'Service Area') + '</span>' +
            '<span style="font-size:.82rem;font-weight:600;color:#1e293b;">🏭 ' + item.supply_ability + '</span>';
        grid.appendChild(saEl);
    }

    // Country of Origin (products)
    if (item.country_of_origin) {
        var coEl = document.createElement('div');
        coEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">Made In</span>' +
            '<span style="font-size:.82rem;font-weight:600;color:#1e293b;">🌍 ' + item.country_of_origin + '</span>';
        grid.appendChild(coEl);
    }

    // Date Added
    var dateStr = item.created_at ? item.created_at.substring(0,10) : '—';
    var daEl = document.createElement('div');
    daEl.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">Date Added</span>' +
        '<span style="font-size:.82rem;font-weight:600;color:#1e293b;">📅 ' + dateStr + '</span>';
    grid.appendChild(daEl);

    card.appendChild(grid);

    // Certifications
    if (item.certifications) {
        var certDiv = document.createElement('div');
        certDiv.style.cssText = 'margin-top:.75rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:7px;padding:.4rem .75rem;font-size:.78rem;color:#065f46;font-weight:600;';
        certDiv.innerHTML = '🏅 ' + item.certifications;
        card.appendChild(certDiv);
    }

    // Keywords
    if (item.keywords) {
        var kwDiv = document.createElement('div');
        kwDiv.style.cssText = 'margin-top:.5rem;font-size:.74rem;color:#64748b;';
        kwDiv.innerHTML = '<i class="bi bi-tags me-1"></i>' + item.keywords;
        card.appendChild(kwDiv);
    }

    // Rejection reason
    if (item.rejection_reason && item.status === 'rejected') {
        var rjDiv = document.createElement('div');
        rjDiv.style.cssText = 'margin-top:.75rem;background:#fee2e2;border:1px solid #fca5a5;border-radius:7px;padding:.5rem .75rem;font-size:.78rem;color:#991b1b;font-weight:600;';
        rjDiv.innerHTML = '<i class="bi bi-x-circle me-1"></i><strong>Rejected:</strong> ' + item.rejection_reason;
        card.appendChild(rjDiv);
    }

    body.appendChild(card);

    // Action buttons
    var actions = document.createElement('div');
    actions.style.cssText = 'display:flex;gap:.6rem;flex-wrap:wrap;margin-top:.25rem;';

    // Publish button for draft products
    if (item.type === 'product' && (item.status === 'draft' || item.status === 'rejected')) {
        var pubBtn = document.createElement('button');
        pubBtn.style.cssText = 'flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:6px;padding:.55rem 1rem;background:#059669;color:#fff;border-radius:10px;font-size:.84rem;font-weight:700;border:none;cursor:pointer;';
        pubBtn.innerHTML = '<i class="bi bi-send-fill"></i> ' + (item.status === 'draft' ? 'Publish Now' : 'Resubmit');
        pubBtn.onclick = function() {
            if (confirm('Submit this product for admin review?')) {
                // Call Livewire publish method
                var lwEl = document.querySelector('[wire\\:id]');
                if (lwEl) {
                    Livewire.find(lwEl.getAttribute('wire:id')).call('publishProduct', item.id);
                    closeListingDetail();
                }
            }
        };
        actions.appendChild(pubBtn);
    }

    // Edit button — hidden for approved listings
    if (item.status !== 'approved') {
        var editBtn = document.createElement('a');
        editBtn.href = item.edit_route;
        editBtn.style.cssText = 'flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:6px;padding:.55rem 1rem;background:#1d4ed8;color:#fff;border-radius:10px;font-size:.84rem;font-weight:700;text-decoration:none;';
        editBtn.innerHTML = '<i class="bi bi-pencil"></i> Edit Listing';
        actions.appendChild(editBtn);
    } else {
        var lockedMsg = document.createElement('div');
        lockedMsg.style.cssText = 'flex:1;padding:.55rem 1rem;background:#d1fae5;color:#065f46;border-radius:10px;font-size:.82rem;font-weight:600;text-align:center;border:1px solid #6ee7b7;';
        lockedMsg.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Approved — contact support to edit';
        actions.appendChild(lockedMsg);
    }

    body.appendChild(actions);

    // Open the drawer
    document.getElementById('ld-overlay').classList.add('open');
    document.getElementById('ld-drawer').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function mkBanner(bg, color, icon, text) {
    var d = document.createElement('div');
    d.style.cssText = 'background:' + bg + ';border-radius:8px;padding:.65rem .9rem;font-size:.78rem;color:' + color + ';font-weight:600;margin-bottom:.75rem;display:flex;align-items:center;gap:.4rem;';
    d.innerHTML = '<i class="bi bi-' + icon + '"></i> ' + text;
    return d;
}

function addField(parent, label, value, valStyle) {
    var d = document.createElement('div');
    d.style.cssText = 'margin-bottom:.5rem;';
    d.innerHTML = '<span style="font-size:.68rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:2px;">' + label + '</span>' +
        '<span style="' + (valStyle || 'font-size:.88rem;font-weight:600;color:#1e293b;') + '">' + value + '</span>';
    parent.appendChild(d);
}

function closeListingDetail() {
    document.getElementById('ld-overlay').classList.remove('open');
    document.getElementById('ld-drawer').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeListingDetail(); });
</script>

</div>{{-- end wire:ignore --}}

<livewire:seller.layout.footer />
</div>