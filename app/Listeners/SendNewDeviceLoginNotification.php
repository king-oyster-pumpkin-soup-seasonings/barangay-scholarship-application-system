<?php

namespace App\Listeners;

use App\Notifications\NewDeviceLoginNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SendNewDeviceLoginNotification
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $request = request();
        $userAgent = (string) $request->userAgent();
        $ipAddress = (string) $request->ip();
        $signature = Hash::make($userAgent.'|'.$ipAddress);
        $sessionKey = 'device_login_signature';

        if ($request->session()->has($sessionKey)
            && Hash::check($userAgent.'|'.$ipAddress, (string) $request->session()->get($sessionKey))) {
            return;
        }

        $request->session()->put($sessionKey, $signature);

        $event->user->notify(new NewDeviceLoginNotification(
            device: $this->deviceName($userAgent),
            location: $ipAddress === '' ? 'Unknown location' : $ipAddress,
            loginTime: now()->format('M d, Y h:i A T'),
        ));
    }

    private function deviceName(string $userAgent): string
    {
        if ($userAgent === '') {
            return 'Unknown device';
        }

        return Str::of($userAgent)->limit(120)->toString();
    }
}
