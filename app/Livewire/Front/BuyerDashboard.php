<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class BuyerDashboard extends Component
{
    public $buyerEmail;

    public $totalRfq = 0;
    public $activeInquiries = 0;
    public $savedSuppliers = 0;
    public $unreadMessages = 0;

   public function mount()
{
    if(!session('buyer_id')){
        return redirect()->route('buyer.login');
    }

    $buyerId = session('buyer_id');
    $this->buyerEmail = session('buyer_email');

    // Total RFQ
    if (Schema::hasTable('rfqs')) {
        $this->totalRfq = DB::table('rfqs')
            ->where('buyer_id', $buyerId)
            ->count();
    } else {
        $this->totalRfq = 0;
    }

    // Active inquiries
    if (Schema::hasTable('inquiries')) {
        $this->activeInquiries = DB::table('inquiries')
            ->where('buyer_id', $buyerId)
            ->count();
    } else {
        $this->activeInquiries = 0;
    }

    // Saved suppliers
    if (Schema::hasTable('saved_suppliers')) {
        $this->savedSuppliers = DB::table('saved_suppliers')
            ->where('buyer_id', $buyerId)
            ->count();
    } else {
        $this->savedSuppliers = 0;
    }

    // Messages
    if (Schema::hasTable('messages')) {
        $this->unreadMessages = DB::table('messages')
            ->where('buyer_id', $buyerId)
            ->where('is_read', 0)
            ->count();
    } else {
        $this->unreadMessages = 0;
    }
}

    public function logout()
    {
        session()->forget(['buyer_id','buyer_email']);
        return redirect()->route('buyer.login');
    }

    public function render()
    {
        return view('livewire.front.buyer-dashboard');
    }
}