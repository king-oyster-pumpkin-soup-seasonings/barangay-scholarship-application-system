<?php

namespace App\Http\Middleware;

use App\Models\SystemSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ConfigureSessionTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        config(['session.lifetime' => $this->timeoutMinutes()]);

        return $next($request);
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

        return SystemSetting::normalizeSessionTimeout(config('session.lifetime', 20));
    }
}
