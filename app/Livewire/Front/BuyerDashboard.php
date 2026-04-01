<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
    use App\Models\Quotation;


class BuyerDashboard extends Component
{
    public $buyerEmail;
public $buyerFullName;
    public $totalRfq = 0;
    public $activeInquiries = 0;
    public $savedSuppliers = 0;
    public $unreadMessages = 0;
    public $totalQuotations = 0;

public function mount()
{
    if (!session('buyer_uuid')) {
        return redirect()->route('buyer.login');
    }

    $buyerUuid = session('buyer_uuid');

    // Email
    $this->buyerEmail = session('buyer_email');

    // Full Name
    if (Schema::hasTable('buyers')) {
        $buyer = DB::table('buyers')
            ->where('id', $buyerUuid) // ✅ UUID
            ->first();

        if ($buyer) {
            $this->buyerFullName = $buyer->full_name ?? '';
        }
    }

    // ✅ Total RFQ
    if (Schema::hasTable('rfqs')) {
        $this->totalRfq = DB::table('rfqs')
            ->where('buyer_uuid', $buyerUuid) // 🔥 FIX
            ->count();
    }
 $this->totalQuotations = Quotation::where('buyer_uuid', $buyerUuid)->count();
    // Active inquiries (if still using id, leave it OR migrate later)
    if (Schema::hasTable('inquiries')) {
        $this->activeInquiries = DB::table('inquiries')
            ->where('buyer_uuid', $buyerUuid) // 🔥 FIX (if column exists)
            ->count();
    }

    // Saved suppliers
    if (Schema::hasTable('saved_suppliers')) {
        $this->savedSuppliers = DB::table('saved_suppliers')
            ->where('buyer_uuid', $buyerUuid) // 🔥 FIX
            ->count();
    }

    // Messages
    if (Schema::hasTable('messages')) {
        $this->unreadMessages = DB::table('messages')
            ->where('buyer_uuid', $buyerUuid) // 🔥 FIX
            ->where('is_read', 0)
            ->count();
    }
}

    public function logout()
    {
        session()->forget(['buyer_id','buyer_uuid','buyer_email','buyer_name']);
        return redirect()->route('buyer.login');
    }

    public function render()
    {
        return view('livewire.front.buyer-dashboard');
    }
}