<?php
// FILE: app/Http/Middleware/SellerAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // ── 1. Must be logged in ──────────────────────────────
        if (!session('seller_id')) {
            return redirect()->route('seller.login')
                ->with('error', 'Please login to access your seller dashboard.');
        }

        $seller = \App\Models\Seller::find(session('seller_id'));

        if (!$seller) {
            session()->forget(['seller_id', 'id', 'seller_email', 'seller_name']);
            return redirect()->route('seller.login')
                ->with('error', 'Session expired. Please login again.');
        }

        // ── 2. Suspended check ────────────────────────────────
        if ($seller->is_active == 0) {
            session()->forget(['seller_id', 'id', 'seller_email', 'seller_name']);
            return redirect()->route('seller.login')
                ->with('error', 'Your account has been suspended. Please contact support.');
        }

        // ── 3. Force password change ──────────────────────────
        if ($seller->must_change_password == 1
            && !$request->routeIs('seller.set-password')
            && !$request->routeIs('seller.logout')
        ) {
            return redirect()->route('seller.set-password');
        }

        // ── 4. Product routes ────────────────────────────────
        // product_add: sellers can add products/services even while pending
        //   — they save as DRAFT (status=3), published once account approved
        // product_list: only show if approved (nothing to show otherwise)
        $approvedOnlyRoutes = [
            'product_list',
            'seller-product-edit',
            'product_gallery',
            'hotdealproductform',
        ];

        if (collect($approvedOnlyRoutes)->contains(fn($r) => $request->routeIs($r))) {
            if ($seller->status !== 'approved') {
                return redirect()->route('seller.dashboard')
                    ->with('info', '⏳ Your account is under review. Products go live once approved.');
            }
        }

        // ── All other routes: allow freely ────────────────────
        $request->merge(['_seller' => $seller]);
        return $next($request);
    }
}