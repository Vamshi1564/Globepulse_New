{{-- FILE: resources/views/livewire/seller/my-listings.blade.php --}}
<div>
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
.btn-edit{font-size:.74rem;padding:5px 12px;border-radius:8px;border:1.5px solid #1d4ed8;
  background:#eff6ff;color:#1d4ed8;font-weight:700;cursor:pointer;text-decoration:none;transition:all .15s;display:inline-block;}
.btn-edit:hover{background:#1d4ed8;color:#fff;}
.btn-publish-now{font-size:.74rem;padding:5px 12px;border-radius:8px;
  border:1.5px solid #059669;background:#f0fdf4;color:#059669;font-weight:700;cursor:pointer;
  transition:all .15s;display:inline-block;}
.btn-publish-now:hover{background:#059669;color:#fff;}
.btn-del{font-size:.74rem;padding:5px 12px;border-radius:8px;border:1.5px solid #ef4444;
  background:#fff;color:#ef4444;font-weight:700;cursor:pointer;transition:all .15s;display:inline-block;}
.btn-del:hover{background:#fee2e2;}

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
</style>

<div class="ml-wrap">

  @if(session('message'))
  <div class="ml-alert success"><i class="bi bi-check-circle-fill"></i> {{ session('message') }}</div>
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
      <input wire:model.debounce.400ms="search" class="ml-search"
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
        @forelse($listings as $item)
        <tr>
          <td style="color:#94a3b8;font-size:.75rem;font-weight:600;">
            {{ $listings->firstItem() + $loop->index }}
          </td>

          <td>
            @if($item->image)
              <img src="{{ config('app.pub_aws_url') . $item->image }}" class="ml-thumb"
                   onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
              <div class="ml-thumb-placeholder" style="display:none;">
                {{ $item->type === 'product' ? '📦' : '🛠️' }}
              </div>
            @else
              <div class="ml-thumb-placeholder">
                {{ $item->type === 'product' ? '📦' : '🛠️' }}
              </div>
            @endif
          </td>

          <td>
            <div style="font-weight:700;color:#0f172a;font-size:.86rem;line-height:1.3;">
              {{ Str::limit($item->title, 55) }}
            </div>
          </td>

          <td>
            <span class="ml-type-badge {{ $item->type === 'product' ? 'type-product' : 'type-service' }}">
              {{ $item->type === 'product' ? '📦 Product' : '🛠️ Service' }}
            </span>
          </td>

          <td>
            <span style="font-weight:700;color:#059669;font-size:.84rem;">{{ $item->price }}</span>
          </td>

          <td style="font-size:.76rem;color:#64748b;max-width:160px;">
            {{ $item->meta }}
          </td>

          <td>
            @php
              $statusClass = match($item->status) {
                'approved' => 'st-approved',
                'rejected' => 'st-rejected',
                'inactive' => 'st-inactive',
                default    => 'st-pending',
              };
              $statusLabel = match($item->status) {
                'approved' => '✅ Approved',
                'rejected' => '❌ Rejected',
                'inactive' => '⏸ Inactive',
                default    => '⏳ Pending',
              };
            @endphp
            <span class="ml-status {{ $statusClass }}">{{ $statusLabel }}</span>
          </td>

          <td style="font-size:.76rem;color:#94a3b8;white-space:nowrap;">
            {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '—' }}
          </td>

          <td>
            <div style="display:flex;gap:5px;align-items:center;flex-wrap:wrap;">
              {{-- Publish Now button for drafts --}}
              @if($item->status === 'draft' && $item->type === 'product')
                <button class="btn-publish-now"
                  wire:click="publishProduct({{ $item->id }})"
                  title="Submit for admin review">
                  <i class="bi bi-send-fill" style="font-size:.7rem;"></i> Publish
                </button>
              @endif
              <a href="{{ $item->edit_route }}" class="btn-edit">
                <i class="bi bi-pencil" style="font-size:.7rem;"></i> Edit
              </a>
              @if($item->type === 'product')
                <button class="btn-del"
                  wire:click="deleteProduct({{ $item->id }})"
                  onclick="return confirm('Delete this product?')">
                  <i class="bi bi-trash" style="font-size:.7rem;"></i>
                </button>
              @else
                <button class="btn-del"
                  wire:click="deleteService({{ $item->id }})"
                  onclick="return confirm('Delete this service?')">
                  <i class="bi bi-trash" style="font-size:.7rem;"></i>
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

</div>

<livewire:seller.layout.footer />
</div>