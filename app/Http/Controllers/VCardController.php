<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VCardController extends Controller
{
    public function download($leadId)
    {
        $lead = DB::table('tblleads')->find($leadId);

        if (!$lead) {
            abort(404);
        }

        $pdf = Pdf::loadView('livewire.seller.v-card', compact('lead', 'imageSrc'));
        return $pdf->download("vcard_{$lead->id}.pdf");
    }
}
