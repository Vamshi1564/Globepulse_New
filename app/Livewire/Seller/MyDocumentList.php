<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use App\Models\Documents;
use App\Models\DocumentsUpload;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class MyDocumentList extends Component
{

    public $documents = [];

    public function mount()
    {

        $CustomerId = Session::get('id');
        $this->documents = DocumentsUpload::with('documents')->where('lead_id', $CustomerId)->where('is_deleted', 0)->where('doc_status', '!=', 2)->get();
    }

    public function render()
    {
        return view('livewire.seller.my-document-list');
    }
}
