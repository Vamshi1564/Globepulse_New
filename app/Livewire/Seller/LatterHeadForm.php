<?php

namespace App\Livewire\Seller;

use App\Models\LetterHeadModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class LatterHeadForm extends Component
{

    use WithFileUploads;

    public $company_name, $company_address, $web_link, $company_email, $phone_no;
    public $letterHeads;
    public $logo;



    // public function mount()
    // {
    //     $customerId = Session::get('id'); // Get the currently logged-in user's ID
    //     $this->letterHeads = LetterHeadModel::where('customer_id', $customerId)
    //         ->first();
    // }
    // Method to handle form submission and save data to the database
    public function addData()
    {
        // Validate input data if necessary
        $this->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'web_link' => 'nullable|url',
            'company_email' => 'required|email',
            'phone_no' => 'required|string',
            'logo' => 'required', // 1MB max size

        ]);

        // Get customer_id from the session
        $customerId = Session::get('id');
        // Save data to DB

        // Check if a letterhead already exists for this customer
        $existing = LetterHeadModel::where('customer_id', $customerId)->first();
        if ($existing) {
            session()->flash('error', 'You have already created a letterhead.');
            return;
        }

        $originalName = $this->logo->getClientOriginalName();
        $nameOnly = preg_replace('/[[:space:]]+/', '-', trim(preg_replace('/\x{00A0}/u', ' ', pathinfo($originalName, PATHINFO_FILENAME))));
        $extension = $this->logo->getClientOriginalExtension();
        $randomNumber = rand(1000, 999999);
        $uniqueName = $nameOnly . '-' . $randomNumber . '.' . $extension;

        $this->logo->storeAs('public/uploads/latterhead-logos', $uniqueName, 's3');
        $imagePath = 'uploads/latterhead-logos/' . $uniqueName;

        LetterHeadModel::create([
            'logo' => $imagePath,
            'company_name' => $this->company_name,
            'company_address' => $this->company_address,
            'web_link' => $this->web_link,
            'company_email' => $this->company_email,
            'phone_no' => $this->phone_no,
            'customer_id' => $customerId,
        ]);

        // Reset input fields
        $this->reset();

        // Flash message to indicate success
        session()->flash('message', 'Letterhead Added Successfully!');

        return redirect()->route('latterhead-list', ['id' => $customerId]);
    }
    // public function downloadPdf()
    // {
    //     if (!$this->letterHeads) {
    //         session()->flash('error', 'No letterhead data to download.');
    //         return;
    //     }

    //     $pdf = Pdf::loadView('livewire.seller.latter-head', [
    //         'letterHeads' => $this->letterHeads,
    //     ]);

    //     $pdf->setPaper('a4', 'portrait');
    //     $pdf->setOption('dpi', 150);
    //     $pdf->setOption('defaultFont', 'sans-serif');
    //     $pdf->setOption('isHtml5ParserEnabled', true);
    //     $pdf->setOption('isRemoteEnabled', true);
    //     $pdf->setOption('isPhpEnabled', true);

    //     // Try shrinking content to fit
    //     $pdf->setOption('enable-smart-shrinking', true); // For DomPDF >= 0.8.5
    //     // return $pdf->download('letterhead.pdf');
    //     return response()->streamDownload(function () use ($pdf) {
    //         echo $pdf->output();
    //     }, 'letterhead.pdf');
    // }

    public function render()
    {

        return view('livewire.seller.latter-head-form');
    }
}
