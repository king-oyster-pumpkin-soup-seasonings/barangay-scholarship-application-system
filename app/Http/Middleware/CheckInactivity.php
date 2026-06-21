<?php

namespace App\Http\Middleware;

use App\Models\SystemSetting;
use Carbon\CarbonInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CheckInactivity
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = $request->session()->get('last_activity');
            $timeoutMinutes = $this->timeoutMinutes();

            if ($lastActivity && $this->isExpired($lastActivity, $timeoutMinutes)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('error', "Your session expired after {$timeoutMinutes} minutes of inactivity. Please sign in again.");
            }

            $request->session()->put('last_activity', now());
        }

        return $next($request);
    }

    private function isExpired(mixed $lastActivity, int $timeoutMinutes): bool
    {
        if (! $lastActivity instanceof CarbonInterface) {
            $lastActivity = Carbon::parse($lastActivity);
        }

        return $lastActivity->copy()->addMinutes($timeoutMinutes)->lessThanOrEqualTo(now());
    }

    private function timeoutMinutes(): int
    {
        try {
            if (Schema::hasTable('system_settings')) {
                return SystemSetting::sessionTimeoutMinutes();
            }
        } catch (Throwable) {
            //
        }

        return (int) config('session.lifetime', 20);
    }
}
