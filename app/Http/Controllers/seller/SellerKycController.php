<?php
// FILE: app/Http/Controllers/Seller/SellerKycController.php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
 
class SellerKycController extends Controller
{
    /**
     * DigiLocker callback — Setu redirects seller here after consent.
     *
     * Setu sends:
     *   success=True&id={uuid}&scope=ADHAR%2BPANCR   ← consent given
     *   success=False&id={uuid}&errMessage={msg}      ← cancelled/failed
     *
     * We store the request ID in session, then redirect back to profile
     * with ?digilocker_done=1 so the JS auto-triggers checkDigiLockerStatus().
     */
    public function digilockerCallback(Request $request)
    {
        $success   = $request->query('success', 'False');
        $requestId = $request->query('id', '');
        $scope     = $request->query('scope', '');
        $errMsg    = $request->query('errMessage', '');

        Log::info('DigiLocker callback', [
            'success'    => $success,
            'request_id' => $requestId,
            'scope'      => $scope,
        ]);

        if ($requestId) {
            Session::put('digilocker_request_id', $requestId);
        }

        if (strtolower($success) === 'true') {
            Session::put('digilocker_callback_status', 'authenticated');
            return redirect(url('/seller/profile') . '?digilocker_done=1')
                ->with('success', 'DigiLocker authorized! Fetching your documents…');
        }

        Session::put('digilocker_callback_status', 'failed');
        return redirect(url('/seller/profile') . '?digilocker_done=0')
            ->with('error', $errMsg ?: 'DigiLocker authorization was not completed. You can upload documents manually.');
    }

    /**
     * Aadhaar callback — fallback if Aadhaar uses separate redirect.
     * In this app, Aadhaar goes through DigiLocker, so this rarely fires.
     */
    public function aadhaarCallback(Request $request)
    {
        $requestId = $request->query('id', '');

        Log::info('Aadhaar callback', ['request_id' => $requestId]);

        if ($requestId) {
            Session::put('aadhaar_request_id', $requestId);
        }

        return redirect(url('/seller/profile') . '?aadhaar_done=1')
            ->with('success', 'Return to the form and click "Check Status" to complete verification.');
    }
}