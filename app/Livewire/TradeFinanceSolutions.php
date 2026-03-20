<?php

namespace App\Livewire;

use App\Models\TradeFinanceInquiry;
use App\Models\TradeFinanceInquiryType;
use Livewire\Component;

class TradeFinanceSolutions extends Component
{

    public $name, $phonenumber, $email, $subject, $inquiry_type;

    public function submit()
    {
        date_default_timezone_set('Asia/Kolkata');

        TradeFinanceInquiry::create([
            'name' => $this->name,
            'phonenumber' => $this->phonenumber,
            'email' => $this->email,
            'subject' => $this->subject,
            'inquiry_type' => $this->inquiry_type,
        ]);

        session()->flash('message', 'Form submitted successfully!');
        $this->reset();
    }


    public function mount()
    {
        $this->resetForm(); // Reset form when component loads
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation(); // Clear validation errors
    }


    public function render()
    {
        $tradeinquiry_type = TradeFinanceInquiryType::all();
        return view('livewire.trade-finance-solutions' , compact('tradeinquiry_type'));
    }
}
