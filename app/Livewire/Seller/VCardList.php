<?php

// namespace App\Livewire\Seller;

// use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Support\Facades\DB;
// use Livewire\Component;

// class VCardList extends Component
// {

//     public function download($leadId, $type)
//     {
//         $lead = DB::table('tblleads')->find($leadId);

//         if (!$lead) {
//             abort(404, 'Lead not found.');
//         }

//         // Allowed types
//         $validTypes = ['style1', 'style2', 'style3', 'style4', 'style5'];
//         if (!in_array($type, $validTypes)) {
//             abort(404, 'Invalid card type.');
//         }

//         // Background image per type
//         $imagePath = public_path("assets/img/bg/CARD" . substr($type, -1) . ".jpg"); // CARD1.jpg, CARD2.jpg, etc.
//         if (!file_exists($imagePath)) {
//             abort(404, 'Card image not found.');
//         }

//         $imageData = base64_encode(file_get_contents($imagePath));
//         $imageSrc = 'data:image/jpg;base64,' . $imageData;

//         $pdf = Pdf::loadView('livewire.seller.v-card', compact('lead', 'imageSrc', 'type'));
//         return $pdf->download("vcard_{$lead->id}_{$type}.pdf");
//     }


//     public function render()
//     {
//         return view('livewire.seller.v-card-list');
//     }
// }
// namespace App\Livewire\Seller;

// use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Support\Facades\DB;
// use Livewire\Component;

// class VCardList extends Component
// {
//     public $lead;

//     public function mount($leadId)
//     {
//         $this->lead = DB::table('tblleads')->find($leadId);
//     }
//     public function generateVCard($type)
//     {
//         // Allowed types for the vCard
//         $validTypes = ['style1', 'style2', 'style3', 'style4', 'style5'];

//         // Ensure the type is valid
//         if (!in_array($type, $validTypes)) {
//             abort(404, 'Invalid card type.');
//         }

//         // Determine the background image for the selected type
//         $imagePath = public_path("assets/img/bg/CARD" . substr($type, -1) . ".png"); // CARD1.jpg, CARD2.jpg, etc.

//         // Check if the image exists
//         if (!file_exists($imagePath)) {
//             abort(404, 'Card image not found.');
//         }

//         // Encode the image in base64
//         $imageData = base64_encode(file_get_contents($imagePath));
//         $imageSrc = 'data:image/jpg;base64,' . $imageData;

//         // Load the PDF view with the image
//         $pdf = Pdf::loadView('livewire.seller.v-card', compact('imageSrc', 'type'));

//         // Stream the PDF in the browser (show it without downloading)
//         return $pdf->stream("vcard_{$type}.pdf");
//     }

//     public function render()
//     {
//         return view('livewire.seller.v-card-list');
//     }
// }

namespace App\Livewire\Seller;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class VCardList extends Component
{
    // Fetch the card types automatically
    public $cardTypes = [
        ['type' => 'style1', 'image' => 'CARD1.png'],
        ['type' => 'style2', 'image' => 'CARD2.png'],
        ['type' => 'style3', 'image' => 'CARD3.png'],
        ['type' => 'style4', 'image' => 'CARD4.jpg'],
        ['type' => 'style5', 'image' => 'CARD5.jpg'],
    ];

    public $leadId;

    public $icons = [];

    public function mount()
    {
        $this->leadId = Session::get(key: 'id');

        // Load social icons
        $this->icons = $this->loadIcons();
    }

    public function downloadVCard($type)
    {
        $card = collect($this->cardTypes)->firstWhere('type', $type);

        if (!$card) {
            abort(404, 'Invalid card type.');
        }

        // Load lead details
        $lead = DB::table('tblleads')->find($this->leadId);

        if (!$lead) {
            abort(404, 'Lead not found.');
        }

        // Prepare image path
        $imagePath = public_path("assets/img/bg/{$card['image']}");
        if (!file_exists($imagePath)) {
            abort(404, 'Card image not found.');
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Load PDF view (make sure the Blade file exists)
        $pdf = Pdf::loadView('livewire.seller.v-card', [
            'lead' => $lead,
            'type' => $type,
            'cardImage' => $imageSrc,
            'icons' => $this->icons,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "vcard_{$lead->id}_{$type}.pdf");
    }


    private function loadIcons()
    {
        $iconNames = ['facebook', 'twitter', 'instagram', 'linkedin'];
        $icons = [];

        foreach ($iconNames as $icon) {
            $iconPath = public_path("assets/img/bg/{$icon}.png");
            if (file_exists($iconPath)) {
                $encoded = base64_encode(file_get_contents($iconPath));
                $icons[$icon] = 'data:image/png;base64,' . $encoded;
            } else {
                $icons[$icon] = null; // or a default icon if you prefer
            }
        }

        return $icons;
    }

    public function render()
    {
        // Return the view with the list of card types
        return view('livewire.seller.v-card-list', [
            'cardTypes' => $this->cardTypes,
            'icons' => $this->icons,
        ]);
    }
}
