<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class BuyerDashboard extends Component
{
    public $buyerEmail;
public $buyerFullName;
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

    // Email
    $this->buyerEmail = session('buyer_email');

    // Full Name
    if (Schema::hasTable('buyers')) {
        $buyer = DB::table('buyers')
            ->where('id', $buyerId)
            ->first();

        if($buyer){
            $this->buyerFullName = $buyer->full_name ?? $buyer->name ?? '';
        }
    }

    // Total RFQ
    if (Schema::hasTable('rfqs')) {
        $this->totalRfq = DB::table('rfqs')
            ->where('buyer_id', $buyerId)
            ->count();
    }

    // Active inquiries
    if (Schema::hasTable('inquiries')) {
        $this->activeInquiries = DB::table('inquiries')
            ->where('buyer_id', $buyerId)
            ->count();
    }

    // Saved suppliers
    if (Schema::hasTable('saved_suppliers')) {
        $this->savedSuppliers = DB::table('saved_suppliers')
            ->where('buyer_id', $buyerId)
            ->count();
    }

    // Messages
    if (Schema::hasTable('messages')) {
        $this->unreadMessages = DB::table('messages')
            ->where('buyer_id', $buyerId)
            ->where('is_read', 0)
            ->count();
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