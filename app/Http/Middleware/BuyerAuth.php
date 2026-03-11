<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BuyerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('buyer_id')) {
            return redirect()->route('buyer.login')
                ->with('error','Please login first.');
        }

        return $next($request);
    }
}