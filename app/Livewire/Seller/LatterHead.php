<?php

// namespace App\Livewire\Seller;

// use App\Models\LetterHeadModel;
// use Barryvdh\DomPDF\Facade\Pdf;
// use Livewire\Component;
// use Illuminate\Support\Facades\Session;

// class LatterHead extends Component
// {
//     public $letterHeads;
//     public $customerId;
//     public $icons = [];

//     public function mount($id)
//     {
//         // Get customer ID from session
//         $this->customerId = Session::get('id');

//         // Fetch the letterhead record based on customer_id from the session
//         $this->fetchLetterHead($id);

//         $this->icons = $this->loadIcons();
//     }

//     public function fetchLetterHead($id)
//     {
//         // Fetch the letterhead based on customer_id and the provided id
//         $this->letterHeads = LetterHeadModel::where('customer_id', $this->customerId)
//             ->where('customer_id', operator: $id)
//             ->first();

//         // Handle case where no letterhead is found
//         if (!$this->letterHeads) {
//             session()->flash('error', 'No letterhead found for this customer.');
//         }
//     }

//     private function loadIcons()
//     {
//         $iconNames = ['location', 'email', 'phone', 'world'];
//         $icons = [];

//         foreach ($iconNames as $icon) {
//             $iconPath = public_path("assets/img/bg/{$icon}.png");
//             if (file_exists($iconPath)) {
//                 $encoded = base64_encode(file_get_contents($iconPath));
//                 $icons[$icon] = 'data:image/png;base64,' . $encoded;
//             } else {
//                 $icons[$icon] = null; // or a default icon if you prefer
//             }
//         }

//         return $icons;
//     }

//     public function render()
//     {
//         return view('livewire.seller.latter-head', [
//             'letterHeads' => $this->letterHeads,
//             'icons' => $this->icons,
//         ]);
//     }
// }


//With multiple latter head show
namespace App\Livewire\Seller;

use App\Models\LetterHeadModel;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LatterHead extends Component
{
    public $letterHeads;
    public $customerId;
    public $icons = [];
    public $type;
    public $imageSrc;

    // Define multiple letterhead types (styles)
    public $letterHeadTypes = [
        ['type' => 'style1', 'image' => 'Business-Letterhead-11.png'],
        ['type' => 'style2', 'image' => 'Business-Letterhead-2.png'],
        ['type' => 'style3', 'image' => 'Business-Letterhead-3.png'],
        ['type' => 'style4', 'image' => 'Business-Letterhead-4.png'],
        ['type' => 'style5', 'image' => 'Business-Letterhead-5.png'],
    ];

    public function mount($id, $type = null)
    {
        $this->customerId = Session::get('id');
        $this->type = $type;

        $this->fetchLetterHead($id);
        $this->icons = $this->loadIcons();

        // Match type with defined templates
        $template = collect($this->letterHeadTypes)->firstWhere('type', $type);
        if (!$template) {
            abort(404, 'Invalid letterhead type.');
        }

        // Load selected template image
        $imagePath = public_path("assets/img/bg/{$template['image']}");
        if (!file_exists($imagePath)) {
            abort(404, 'Letterhead image not found.');
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $this->imageSrc = 'data:image/png;base64,' . $imageData;
    }

    public function fetchLetterHead($id)
    {
        $this->letterHeads = LetterHeadModel::where('customer_id', $this->customerId)
            ->where('customer_id', operator: $id) // this line may be a mistake, see below
            ->first();

        if (!$this->letterHeads) {
            session()->flash('error', 'No letterhead found for this customer.');
        }
    }

    private function loadIcons()
    {
        $iconNames = ['location', 'email', 'phone', 'world'];
        $icons = [];

        foreach ($iconNames as $icon) {
            $iconPath = public_path("assets/img/bg/{$icon}.png");
            if (file_exists($iconPath)) {
                $icons[$icon] = 'data:image/png;base64,' . base64_encode(file_get_contents($iconPath));
            } else {
                $icons[$icon] = null;
            }
        }

        return $icons;
    }


    public function render()
    {
        return view('livewire.seller.latter-head', [
            'letterHeads' => $this->letterHeads,
            'imageSrc' => $this->imageSrc,
            'icons' => $this->icons,
        ]);
    }
}
