<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class VCard extends Component
{
    public $lead;
    public $leadId;
    public $type;
    public $imageSrc;
    public $icons = [];

    // List of available card types
    public $cardTypes = [
        ['type' => 'style1', 'image' => 'CARD1.png'],
        ['type' => 'style2', 'image' => 'CARD2.png'],
        ['type' => 'style3', 'image' => 'CARD3.png'],
        ['type' => 'style4', 'image' => 'CARD4.jpg'],
        ['type' => 'style5', 'image' => 'CARD5.jpg'],
    ];

    public function mount($type = null)
    {
        $this->leadId = Session::get('id');

        $this->type = $type;

        // Load lead data
        $this->lead = DB::table('tblleads')->find($this->leadId);

        if (!$this->lead) {
            abort(404, 'Lead not found.');
        }

        // Find matching card type
        $card = collect($this->cardTypes)->firstWhere('type', $type);
        if (!$card) {
            abort(404, 'Invalid card type.');
        }

        // Get image path
        $imagePath = public_path("assets/img/bg/{$card['image']}");
        if (!file_exists($imagePath)) {
            abort(404, 'Card image not found.');
        }

        // Convert to base64
        $imageData = base64_encode(file_get_contents($imagePath));
        $this->imageSrc = 'data:image/png;base64,' . $imageData;

        // ✅ Handle lead profile image safely
        $logoPath = storage_path('app/public/' . $this->lead->profile_image);
        if (!empty($this->lead->profile_image) && is_file($logoPath)) {
            $this->lead->profile_image_base64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        } else {
            $this->lead->profile_image_base64 = null; // No image
        }

        // Load social icons
        $this->icons = $this->loadIcons();
        // dd($this->icons);
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
        return view('livewire.seller.v-card', [
            'lead' => $this->lead,
            'imageSrc' => $this->imageSrc,
            'cardImage' => $this->imageSrc,
            'icons' => $this->icons,
        ]);
    }
}
