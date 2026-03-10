<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (session()->has('id')) {
        //     // Retrieve the customer using the session 'id'
        //     $customer = Customer::find(session('id'));
    
        //     // If customer does not exist or user type is not 'seller'
        //     if (!$customer || $customer->user_type !== 'Seller' && $customer->user_type !== "Both") {
        //         return redirect()->route('signup')->with('error', 'You have to create an account as a seller.');
        //     }
        // } else {
        //     // If there's no session 'id', redirect to login
        //     return redirect()->route('login')->with('error', 'Access Denied, You must be logged in to access this page.');
        // }
    

        if (!session()->has('id')) {
            return redirect()->route('login')->with('error' , 'Access Denied , You must be logged in to access this page.');
        }
        return $next($request);
    }
}
