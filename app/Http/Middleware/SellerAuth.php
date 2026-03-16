<?php
// FILE: app/Http/Middleware/SellerAuth.php
// Updated: Added profile completion redirect + seller status awareness

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerAuth
{
    // Routes that don't need profile completion check
    private const ALWAYS_ALLOWED = [
        'seller.set-password',
        'seller.logout',
        'seller.profile', 
        'profile',            // profile completion page itself
        'seller.dashboard',   // dashboard always accessible (shows status banner)
    ];

    public function handle(Request $request, Closure $next): Response
    {
        // ── 1. Must be logged in ──────────────────────────────
        if (!session('seller_id')) {
            return redirect()->route('seller.login')
                ->with('error', 'Please login to access your seller dashboard.');
        }

        $seller = \App\Models\Seller::with('details')->find(session('seller_id'));

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

        // ── 4. Profile incomplete → redirect to profile ───────
        // Skip if already on an always-allowed route
        $isAlwaysAllowed = collect(self::ALWAYS_ALLOWED)
            ->contains(fn($r) => $request->routeIs($r));

        if (!$isAlwaysAllowed) {
            $details         = $seller->details;
            $profileComplete = $details
                && $details->onboarding_step >= 5
                && in_array($details->kyc_status, ['submitted', 'verified', 'approved']);

            if (!$profileComplete) {
               return redirect()->route('seller.profile')
                    ->with('info', 'Please complete your profile before accessing the seller area.');
            }
        }

        // ── 5. Inject seller into request for easy access ─────
        // Allows any controller/component to do: request()->seller
        $request->merge(['_seller' => $seller]);

        return $next($request);
    }
}