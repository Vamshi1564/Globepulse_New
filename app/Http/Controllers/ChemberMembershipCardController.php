<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChemberMembershipCardController extends Controller
{
    public function download($leadId)
    {
        $lead = DB::table('tblleads')->find($leadId);

        if (!$lead) {
            abort(404);
        }

        // Embed image as base64
        $imagePath = public_path('assets/img/bg/ChemberMembershipCard.jpg');
        // $imagePath = public_path('assets/img/bg/MemberShipCerti.jpg');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/jpg;base64,' . $imageData;

        $pdf = Pdf::loadView('livewire.seller.chamber-membership-card', compact('lead', 'imageSrc'));
        return $pdf->download("ChemberMembershipCard_{$lead->id}.pdf");
    }
}
