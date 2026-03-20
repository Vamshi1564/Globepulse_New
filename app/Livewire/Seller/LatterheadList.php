<?php

// namespace App\Livewire\Seller;

// use Livewire\Component;

// class LatterheadList extends Component
// {
//     public function render()
//     {
//         return view('livewire.seller.latterhead-list');
//     }
// }


namespace App\Livewire\Seller;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LatterheadList extends Component
{
    public $letterHeadTypes = [
        ['type' => 'style1', 'image' => 'Business-Letterhead-11.png'],
        ['type' => 'style2', 'image' => 'Business-Letterhead-2.png'],
        ['type' => 'style3', 'image' => 'Business-Letterhead-3.png'],
        ['type' => 'style4', 'image' => 'Business-Letterhead-4.png'],
        ['type' => 'style5', 'image' => 'Business-Letterhead-5.png'],
    ];

    public $customerId;
    public $letterHeadData;
    public $icons = [];

    public function mount()
    {
        $this->customerId = Session::get('id');

        // Fetch customer letterhead info
        $this->letterHeadData = DB::table('letter_heads')
            ->where('customer_id', $this->customerId)
            ->first();

        // Load icons if required
        $this->icons = $this->loadIcons();
    }

    public function downloadLetterhead($type)
    {
        $template = collect($this->letterHeadTypes)->firstWhere('type', $type);

        if (!$template) {
            abort(404, 'Invalid letterhead type.');
        }

        if (!$this->letterHeadData) {
            abort(404, 'Letterhead data not found.');
        }

        $imagePath = public_path("assets/img/bg/{$template['image']}");
        if (!file_exists($imagePath)) {
            abort(404, 'Letterhead image not found.');
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        $pdf = Pdf::loadView('livewire.seller.latter-head', [
            'letterHeads' => $this->letterHeadData,
            'type' => $type,
            'imageSrc' => $imageSrc,
            'icons' => $this->icons,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "letterhead_{$this->customerId}_{$type}.pdf");
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
        return view('livewire.seller.latterhead-list', [
            'letterHeadTypes' => $this->letterHeadTypes,
            'icons' => $this->icons,
        ]);
    }
}
