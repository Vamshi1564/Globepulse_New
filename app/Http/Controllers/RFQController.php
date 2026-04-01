<?php

namespace App\Http\Controllers;

use App\Models\RFQ;
use Illuminate\Http\Request;

class RFQController extends Controller
{
    public function delete($id)
    {
        $buyerUuid = session('buyer_uuid') ?? session('buyer_id');

        $rfq = RFQ::where('id', $id)
            ->where('buyer_uuid', $buyerUuid)
            ->first();

        if (!$rfq) {
            return redirect()->route('buyer.myrfqs')
                ->with('message', 'RFQ not found.');
        }

        if ($rfq->quotations()->count() > 0) {
            return redirect()->route('buyer.myrfqs')
                ->with('message', 'Cannot delete RFQ with quotations.');
        }

        $rfq->delete();

        return redirect()->route('buyer.myrfqs')
            ->with('message', 'RFQ deleted successfully.');
    }
}