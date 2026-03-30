<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BuyerInfo extends Component
{
    public int $buyerId;
    public object|null $buyer = null;

    public function mount(string $id): void  // ✅ changed int to string
    {
        $this->buyerId = (int) $id;  // ✅ cast to int inside
        $this->buyer = DB::table('buyers')->where('id', $this->buyerId)->where('is_active', 1)->first();

        if (!$this->buyer) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.front.buyer-info');
    }
}