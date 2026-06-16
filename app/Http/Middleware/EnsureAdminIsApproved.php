<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'admin' && $user->verification_status !== 'verified') {
            abort(403, 'Your admin account is awaiting Superadmin approval.');
        }

        return $next($request);
    }
}
