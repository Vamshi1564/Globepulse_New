<?php

namespace App\Livewire;

use App\Models\LeadConversionDraftModel;
use Illuminate\Database\QueryException;
use Livewire\Component;

class InternetIssue extends Component
{

    public $draftId;
    public $token;

    public function mount($draft = null, $token)
    {
        $this->draftId = $draft;
        $this->token = $token;
    }

    public function retry()
    {
        // ✅ Direct payment page par redirect
        $this->redirectRoute('payment.page', [
            'draft' => $this->draftId,
            'token' => $this->token,

        ]);
    }
    public function render()
    {
        return view('livewire.internet-issue');
    }
}
