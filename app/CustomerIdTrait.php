<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

trait CustomerIdTrait
{
    private function fetchCustomerId()
    {
        $leadId = Session::get('id'); // Use session to get lead ID or any other dynamic ID you have

        $response = Http::post(config('api.base_url') . config('api.customer_all_info'), [
            'lead_id' => $leadId,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->clientId = $data['data'][0]['id'] ?? null; // Assign customer ID directly

            if (!$this->clientId) {
                session()->flash('error', 'Customer ID not found in the response.');
            }
        } else {
        session()->flash('error', 'Failed to fetch customer information.');
        }
    }
}