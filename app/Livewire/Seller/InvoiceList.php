<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Itemable;
use App\StatusTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class InvoiceList extends Component
{
    public $pendingAmount;
    public $name;
    public $phone;
    public $paymentTotalPages = 1;
    public $paymentPage = 1;
    public $paymentPerPage = 5;
    public $invoices = [];

    public function nextPagePayment()
    {
        if ($this->paymentPage < $this->paymentTotalPages) {
            $this->paymentPage++;
        }
    }

    public function prevPagePayment()
    {
        if ($this->paymentPage > 1) {
            $this->paymentPage--;
        }
    }

    public function render()
    {
        $leadid = Session::get('id');
        $customer = Customer::find($leadid);
        $clientid = $customer->client_id;
        $this->name = $customer->name;
        $this->phone = $customer->phonenumber;

        // $invoices = Invoice::where('clientid', $clientid)->get();

        // $invoiceId = $invoices->pluck('id'); // Get a list of invoice IDs
        // $itemables = Itemable::whereIn('rel_id', $invoiceId)->get();

        // $invoices = Invoice::with(['itemables', 'taskstatus', 'paymentRecords'])->where('clientid', $clientid)->get();

        $invoiceRecords = DB::table('tblinvoices')
            ->join('tblitemable', 'tblinvoices.id', '=', 'tblitemable.rel_id')
            ->where('tblitemable.rel_type', 'invoice')
            ->leftJoin('tblinvoicepaymentrecords', 'tblinvoices.id', '=', 'tblinvoicepaymentrecords.invoiceid')
            ->leftJoin('tblpayment_modes', 'tblinvoicepaymentrecords.paymentmode', '=', 'tblpayment_modes.id')
            ->select(
                'tblinvoices.id as invoice_id',
                'tblinvoices.total',
                'tblinvoices.date',
                'tblinvoices.sale_agent',
                'tblinvoices.clientid as customer_id',
                'tblitemable.description',
                // 'tblinvoicepaymentrecords.id as payment_id',
                'tblinvoicepaymentrecords.amount as paid_amount',
                'tblinvoicepaymentrecords.date as payment_date',
                'tblpayment_modes.name as payment_mode'
            )
            ->where('tblinvoices.clientid', $clientid)
            ->orderByDesc('tblinvoices.id')
            ->get()
            ->groupBy('invoice_id');



        // Step 3: Map and process each invoice group
        $allInvoices = $invoiceRecords->map(function ($group) {
            $invoice = $group->first();

            $totalPaid = $group->sum('paid_amount');
            $this->pendingAmount = $invoice->total - $totalPaid;

            $links = [];

            foreach ($group as $payment) {
                if ($payment->paid_amount) {
                    $query = http_build_query([
                        'id' => $invoice->invoice_id,
                        'amount' => $payment->paid_amount,
                        'total' => $invoice->total,
                        'pro_name' => $invoice->description,
                        'name' => $this->name ?? 'Customer Name',
                        'mo' => $this->phone ?? '0000000000',
                        'date' => $invoice->payment_date,
                        'mode' => $payment->payment_mode ?? 'Unknown',
                    ]);
                    $links[] = "https://inquiry.gfebusiness.org/pay_pdf/pdf.php?$query";
                }
            }

            $invoice->pendingAmount = $this->pendingAmount;
            $invoice->links = $links;
            return $invoice;
            // return (object)[
            //     'invoice_id'    => $invoice->invoice_id,
            //     'description'   => $invoice->description,
            //     'total'         => $invoice->total,
            //     'date'          => $invoice->date,
            //     'pendingAmount' => $pendingAmount,
            //     'links'         => $links,
            //     'status'        => $pendingAmount == 0 ? 'Payment Done' : 'Pending',
            // ];
        })->values();

        $this->paymentTotalPages = ceil($allInvoices->count() / $this->paymentPerPage);
        $offset = ($this->paymentPage - 1) * $this->paymentPerPage;
        $this->invoices = $allInvoices->slice($offset, $this->paymentPerPage)->values();


        return view('livewire.seller.invoice-list');
    }
}
