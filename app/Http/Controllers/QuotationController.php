<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Support\Facades\Session;

class QuotationController extends Controller
{
    public function accept($id)
    {
        $buyerUuid = Session::get('buyer_uuid');

        $quote = Quotation::where('id', $id)
            ->where('buyer_uuid', $buyerUuid)
            ->firstOrFail();

        // ✅ Accept this quote
        $quote->update(['status' => 1]);

        // ✅ Update RFQ status
        $quote->rfq->update(['status' => 'accepted']);

        // ✅ Reject other quotes (optional but recommended)
        Quotation::where('rfq_id', $quote->rfq_id)
            ->where('id', '!=', $id)
            ->update(['status' => 2]);

        return redirect()->back()->with('message', 'Quotation accepted!');
    }

    public function reject($id)
    {
        $buyerUuid = Session::get('buyer_uuid');

        $quote = Quotation::where('id', $id)
            ->where('buyer_uuid', $buyerUuid)
            ->firstOrFail();

        $quote->update(['status' => 2]);

        return redirect()->back()->with('message', 'Quotation rejected!');
    }
}