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

    // ❌ Reject this quote
    $quote->update(['status' => 2]);
$quote->rfq->update(['status' => 'rejected']);
    // 🔍 Check if any pending quotes still exist
    $remainingQuotes = Quotation::where('rfq_id', $quote->rfq_id)
        ->where('status', 0) // still pending
        ->exists();

    // ❗ If no more quotes left → close RFQ
    if (!$remainingQuotes) {
        $quote->rfq->update(['status' => 'rejected']);
    }

    return redirect()->back()->with('message', 'Quotation rejected!');
}
public function export()
{
    $quotes = Quotation::with(['rfq.product', 'buyer'])->get();

    $fileName = "quotations.csv";

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
    ];

    $callback = function () use ($quotes) {
    $file = fopen('php://output', 'w');

    // HEADER ROW
    fputcsv($file, [
        'Product',
        'Buyer',
        'Unit Price (₹)',
        'Quantity',
        'Total Value (₹)',
        'Delivery',
        'Payment Terms',
        'Status',
        'Date'
    ]);

    foreach ($quotes as $q) {

        $statusText = match($q->status) {
            0 => 'Pending',
            1 => 'Accepted',
            2 => 'Rejected',
            default => 'Unknown'
        };

        fputcsv($file, [
            $q->rfq->product->title ?? '',
            $q->buyer->full_name ?? '',
            $q->price,
            $q->rfq->quantity,
            $q->price * $q->rfq->quantity,
            $q->delivery_time ?? '-',
            $q->payment_terms ?? '-',
            $statusText,
            $q->created_at->format('d-m-Y')
        ]);
    }

    fclose($file);
};

    return response()->stream($callback, 200, $headers);
}
public function delete($id)
{
    $buyerUuid = session('buyer_uuid');

    $quote = Quotation::where('id', $id)
        ->where('buyer_uuid', $buyerUuid)
        ->first();

    if (!$quote) {
        return redirect()->route('buyer.quotations')
            ->with('error', 'Quotation not found.');
    }

    // ❗ Prevent delete if already accepted
    if ($quote->status == 1) {
        return redirect()->route('buyer.quotations')
            ->with('error', 'Accepted quotation cannot be deleted.');
    }

    $quote->delete();

    return redirect()->route('buyer.quotations')
        ->with('success', 'Quotation deleted successfully.');
}
public function cancel($id)
{
    $buyerUuid = session('buyer_uuid');

    $quote = Quotation::where('id', $id)
        ->where('buyer_uuid', $buyerUuid)
        ->firstOrFail();

    // Only cancel if accepted
    if ($quote->status != 1) {
        return redirect()->back()->with('error', 'Only accepted deal can be cancelled.');
    }

    // Reset all quotes to pending
   Quotation::where('rfq_id', $quote->rfq_id)
    ->update(['status' => 0]); // pending quotes

$quote->rfq->update(['status' => 'pending']); // ✅ FIXED

    return redirect()->back()->with('success', 'Deal cancelled successfully.');
}

public function deleteBySeller($id)
{
    $sellerId = session('seller_id');

    $quote = Quotation::where('id', $id)
        ->where('supplier_uuid', $sellerId) // ✅ seller ownership check
        ->first();

    if (!$quote) {
        return redirect()->route('seller.quotations')
            ->with('error', 'Quotation not found.');
    }

    // ❗ Prevent deleting accepted quote
    if ($quote->status == 1) {
        return redirect()->route('seller.quotations')
            ->with('error', 'Accepted quotation cannot be deleted.');
    }

    $quote->delete();

    return redirect()->route('seller.quotations')
        ->with('success', 'Quotation deleted successfully.');
}
}