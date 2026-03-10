<?php

namespace App\Livewire;

use App\Models\LeadConversionDraftModel;
use App\Models\LeadConversionPaymentModel;
use Livewire\Component;

class CustomerPaymentSuccess extends Component
{
    public $draftId;
    public $draft;

    public $amount;
    public $paymentid;
    public $paid_at;
    public $lead;
    public $payment;
    public $token;


    public function mount($draft, $token)
    {
        $this->draftId = $draft;
        $this->token = $token;
        $this->loadDraft();
    }

    public function loadDraft()
    {
        // $this->draft = LeadConversionDraftModel::with('customer')
        //     ->find($this->draftId);

        // if (!$this->draft) return;
        $this->draft = LeadConversionDraftModel::with('customer')
            ->where('id', $this->draftId)
            ->where('payment_token', $this->token)
            ->first();

        if (!$this->draft) {
            abort(403, 'Invalid Link');
        }

        // 🔥 latest payment record
        $this->payment = LeadConversionPaymentModel::where('draft_id', $this->draftId)
            ->latest()
            ->first();

        if ($this->payment) {
            $this->amount = $this->payment->amount;
            $this->paymentid = $this->payment->razorpay_payment_id;
            $this->paid_at = $this->payment->paid_at;
        }

        $this->lead = $this->draft->customer;
    }

    public function render()
    {
        return view('livewire.customer-payment-success');
    }
}
