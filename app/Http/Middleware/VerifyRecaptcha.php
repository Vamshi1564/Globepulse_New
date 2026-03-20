<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VerifyRecaptcha
{
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Skip non-POST
        if (!$request->isMethod('post')) {
            return $next($request);
        }

        // 🔥 SKIP LIVEWIRE REQUESTS (THIS IS THE KEY)
        if ($request->hasHeader('X-Livewire')) {
            return $next($request);
        }

        // 🔐 Normal form captcha check
        $token = $request->input('recaptcha_token');

        if (!$token) {
            abort(403, 'Captcha missing');
        }

        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret'   => config('services.recaptcha.secret'),
                'response' => $token,
                'remoteip' => $request->ip(),
            ]
        )->json();

        if (
            empty($response['success']) ||
            ($response['score'] ?? 0) < 0.5
        ) {
            abort(403, 'Bot detected');
        }

        return $next($request);
    }
}
