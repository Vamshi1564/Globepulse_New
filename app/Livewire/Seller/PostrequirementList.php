<?php

namespace App\Livewire\Seller;

use App\Livewire\Postbyrequirement;
use App\Models\BuyleadEnquiry;
use App\Models\Postrequirment;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PostrequirementList extends Component
{
    public function render()
    {
        $customerId = Session::get('id');
        $postrequirement = Postrequirment::where('customer_id', $customerId)->paginate(10);
        foreach ($postrequirement as $post) {
            $post->lead_count = BuyleadEnquiry::where('postbyrequirement_id', $post->id)->count();
        }    
        return view('livewire.seller.postrequirement-list' , compact('postrequirement'));
    }
}
