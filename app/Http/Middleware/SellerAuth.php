<?php
// FILE: app/Http/Middleware/SellerAuth.php
// New middleware — checks seller session set by SellerLogin.php
// Different from the existing Auth middleware (which is for old customers)

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if seller is logged in via session
        if (!session('seller_id')) {
            return redirect()->route('seller.login')
                ->with('error', 'Please login to access your seller dashboard.');
        }

        // Check seller still exists and is active in DB
        $seller = \App\Models\Seller::find(session('seller_id'));

        if (!$seller) {
            // Seller deleted — clear session
            session()->forget(['seller_id', 'seller_email', 'seller_name']);
            return redirect()->route('seller.login')
                ->with('error', 'Session expired. Please login again.');
        }

        if ($seller->is_active == 0) {
            session()->forget(['seller_id', 'seller_email', 'seller_name']);
            return redirect()->route('seller.login')
                ->with('error', 'Your account has been suspended. Please contact support.');
        }

        // If must change password → force to set-password page
        if ($seller->must_change_password == 1
            && !$request->routeIs('seller.set-password')
            && !$request->routeIs('seller.logout')
        ) {
            return redirect()->route('seller.set-password');
        }

        return $next($request);
    }
}