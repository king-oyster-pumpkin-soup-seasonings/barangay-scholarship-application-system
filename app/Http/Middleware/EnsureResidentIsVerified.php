<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureResidentIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'user' && $user->verification_status !== 'verified') {
            return redirect()->route('verification')
                ->with('message', 'Your residency verification is still being reviewed.');
        }

        return $next($request);
    }
}
