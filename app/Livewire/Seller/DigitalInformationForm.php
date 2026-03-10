<?php

namespace App\Livewire\Seller;

use App\Models\DigitalInformationModel;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class DigitalInformationForm extends Component
{
    use WithFileUploads;

    public $name,
        $company_logo,
        $email,
        $mobile,
        $address,
        $company_name,
        $professional_email,
        $product_list,
        $about_company,
        $birth_date,
        $pan_number,
        $demo_link,
        $reset_key; // For full form reset

    public function submit()
    {
        $lead_id = Session::get('id');
        $this->validate([
            'name'               => 'required|string|max:255',
            'company_logo'       => 'required|image|max:10240', // 10 MB
            'email'              => 'required|email',
            'mobile'             => 'required|string|max:20',
            'address'            => 'required|string|max:255',
            'company_name'       => 'required|string|max:255',
            'professional_email' => 'required|email',
            'product_list'       => 'required|string',
            'about_company'      => 'required|string',
            'birth_date'         => 'required|date',
            'pan_number'         => 'required|string|max:20',
            'demo_link'          => 'required|string',
        ]);

        // Save files
        $companyLogoPath = $this->company_logo->store('company-logos', 'public', 's3');



        // Save to database
        DigitalInformationModel::create([
            'name'               => $this->name,
            'company_logo'       => $companyLogoPath,
            'email'              => $this->email,
            'mobile'             => $this->mobile,
            'address'            => $this->address,
            'company_name'       => $this->company_name,
            'professional_email' => $this->professional_email,
            'product_list'       => $this->product_list,
            'about_company'      => $this->about_company,
            'birth_date'         => $this->birth_date,
            'pan_number'         => $this->pan_number,
            'demo_link'          => $this->demo_link,
            'lead_id'           => $lead_id,
        ]);

        session()->flash('success', 'Form submitted successfully!');
        $this->reset();

        // 🔥 Force full form reset using timestamp key
        $this->reset_key = now()->timestamp;
    }

    public function render()
    {
        $demo_links = \App\Models\DemoLinksModel::orderBy('id', 'asc')->get();

        return view('livewire.seller.digital-information-form', [
            'demo_links' => $demo_links,
        ]);
    }
}
