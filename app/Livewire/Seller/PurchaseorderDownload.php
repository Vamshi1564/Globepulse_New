<?php

namespace App\Livewire\Seller;

use App\Models\PurchaseOrders;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PurchaseorderDownload extends Component
{
    public $purchaseOrder;
    public $customerId;

    public function mount($id)
    {
        $customerId = Session::get('id'); // Get customer ID from session
        $this->customerId = $customerId;
        $this->fetchPurchaseOrder($id);
    }

    public function fetchPurchaseOrder($id)
    {
        $this->purchaseOrder = PurchaseOrders::where('customer_id', $this->customerId)
            ->where('id', $id) // Fetch by ID
            ->first();
    }

    //All currency
    public function getCurrencySymbol($currency)
    {
        $currency = strtoupper($currency);

        // Optional alias corrections
        if ($currency === 'IND') {
            $currency = 'INR';
        }

        $symbols = [
            'USD' => '$',      // US Dollar
            'EUR' => '€',      // Euro
            'GBP' => '£',      // British Pound
            'INR' => '₹',      // Indian Rupee
            'JPY' => '¥',      // Japanese Yen
            'CNY' => '¥',      // Chinese Yuan
            'AUD' => 'A$',     // Australian Dollar
            'CAD' => 'C$',     // Canadian Dollar
            'CHF' => 'CHF',    // Swiss Franc
            'SAR' => '﷼',      // Saudi Riyal
            'AED' => 'د.إ',    // UAE Dirham
            'ZAR' => 'R',      // South African Rand
            'SGD' => 'S$',     // Singapore Dollar
            'NZD' => 'NZ$',    // New Zealand Dollar
            'HKD' => 'HK$',    // Hong Kong Dollar
            'SEK' => 'kr',     // Swedish Krona
            'NOK' => 'kr',     // Norwegian Krone
            'DKK' => 'kr',     // Danish Krone
            'RUB' => '₽',      // Russian Ruble
            'KRW' => '₩',      // South Korean Won
            'THB' => '฿',      // Thai Baht
            'MYR' => 'RM',     // Malaysian Ringgit
            'IDR' => 'Rp',     // Indonesian Rupiah
            'PHP' => '₱',      // Philippine Peso
            'MXN' => 'Mex$',   // Mexican Peso
            'BRL' => 'R$',     // Brazilian Real
            'TRY' => '₺',      // Turkish Lira
            'PLN' => 'zł',     // Polish Zloty
            'VND' => '₫',      // Vietnamese Dong
            'EGP' => 'E£',     // Egyptian Pound
            'PKR' => '₨',      // Pakistani Rupee
            'BDT' => '৳',      // Bangladeshi Taka
        ];

        return $symbols[$currency] ?? strtoupper($currency);    
    }


    public function numberToWords($num)
    {
        $ones = [
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen'
        ];

        $tens = [
            2 => 'Twenty',
            3 => 'Thirty',
            4 => 'Forty',
            5 => 'Fifty',
            6 => 'Sixty',
            7 => 'Seventy',
            8 => 'Eighty',
            9 => 'Ninety'
        ];

        $hundreds = ['', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion'];

        $num = number_format($num, 2, '.', '');
        $num_arr = explode('.', $num);
        $wholenum = $num_arr[0];
        $decnum = isset($num_arr[1]) ? (int)$num_arr[1] : 0; // Ensure decimals are handled

        // Split the number into groups of three digits
        $whole_arr = array_reverse(str_split($wholenum, 3));
        krsort($whole_arr);

        $rettxt = '';
        foreach ($whole_arr as $key => $i) {
            $i = (int) $i; // Ensure it's an integer
            if ($i == 0) continue;

            if ($i < 20) {
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                $rettxt .= $tens[(int)substr($i, 0, 1)];
                if ((int)substr($i, 1, 1) > 0) {
                    $rettxt .= ' ' . $ones[(int)substr($i, 1, 1)];
                }
            } else {
                $rettxt .= $ones[(int)substr($i, 0, 1)] . ' Hundred';
                if ((int)substr($i, 1, 1) > 0) {
                    $rettxt .= ' ' . $tens[(int)substr($i, 1, 1)];
                }
                if ((int)substr($i, 2, 1) > 0) {
                    $rettxt .= ' ' . $ones[(int)substr($i, 2, 1)];
                }
            }

            if ($key > 0) {
                $rettxt .= ' ' . $hundreds[$key] . ' ';
            }
        }

        if ($decnum > 0) {
            $rettxt .= ' and ';
            if ($decnum < 20) {
                $rettxt .= $ones[$decnum];
            } else {
                $rettxt .= $tens[(int)substr($decnum, 0, 1)];
                if ((int)substr($decnum, 1, 1) > 0) {
                    $rettxt .= ' ' . $ones[(int)substr($decnum, 1, 1)];
                }
            }
            $rettxt .= ' Cents';
        }

        return trim($rettxt);
    }

    public function render()
    {

        // $currency = $this->purchaseOrder->first()->currency ?? 'USD';
        $currency = $this->purchaseOrder->currency ?? 'USD';

        $currencySymbol = $this->getCurrencySymbol($currency);

        return view('livewire.seller.purchaseorder-download', [
            'purchaseOrder' => $this->purchaseOrder,
            'currency' => $currency,
            'currencySymbol' => $currencySymbol,
        ]);
    }
}
