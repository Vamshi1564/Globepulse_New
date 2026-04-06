<?php
// FILE: app/Http/Middleware/EnsureSellerApproved.php
//
// USAGE — register in app/Http/Kernel.php:
//   protected $routeMiddleware = [
//       ...
//       'seller.approved' => \App\Http\Middleware\EnsureSellerApproved::class,
//   ];
//
// Then apply to all seller feature routes in routes/web.php:
//   Route::middleware(['seller.auth', 'seller.approved'])->group(function () {
//       Route::get('/seller/dashboard',   [...]);
//       Route::get('/products/add',       [...]);
//       Route::get('/service/add',        [...]);
//       Route::get('/my-listings',        [...]);
//       Route::get('/seller/rfqs',        [...]);
//       Route::get('/seller/quotations',  [...]);
//       Route::get('/postbyrequirement',  [...]);
//       Route::get('/hotdealproductform', [...]);
//       Route::get('/slider-image',       [...]);
//   });
//
// Profile/primary_details must NOT be inside this group —
// sellers need to reach those routes at any status.

namespace App\Http\Middleware;

use App\Models\Seller;
use Closure;
use Illuminate\Http\Request;

class EnsureSellerApproved
{
    /**
     * Map each non-approved status to a user-friendly message.
     */
    private array $messages = [
        'pending'      => 'Please complete your Business Profile and submit it for review before accessing this feature.',
        'under_review' => 'Your account is currently under review (24–48 hrs). This feature will unlock once admin approves your application.',
        'rejected'     => 'Your application was rejected. Please update your Business Profile and resubmit.',
        'suspended'    => 'Your seller account has been suspended. Please contact support.',
    ];

    public function handle(Request $request, Closure $next)
    {
        $sellerId = session('seller_id');
        $seller   = $sellerId ? Seller::find($sellerId) : null;

        // Not logged in — let seller.auth middleware handle redirect
        if (!$seller) {
            return redirect()->route('seller.login');
        }

        // Approved — allow through
        if ($seller->status === 'approved') {
            return $next($request);
        }

        // Any other status — block and redirect to profile with context message
        $message = $this->messages[$seller->status] ?? 'Your account is not yet approved.';

        // AJAX / Livewire requests get a 403 JSON response
        if ($request->expectsJson() || $request->header('X-Livewire')) {
            return response()->json(['message' => $message], 403);
        }

        return redirect()
            ->route('primary_details')
            ->with('approval_required', $message);
    }
}