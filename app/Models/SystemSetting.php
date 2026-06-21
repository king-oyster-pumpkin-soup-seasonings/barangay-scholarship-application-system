<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Model
{
    public const SESSION_TIMEOUT_KEY = 'session_timeout_minutes';

    protected $fillable = [
        'key',
        'value',
    ];

    public static function sessionTimeoutMinutes(): int
    {
        return (int) Cache::rememberForever(self::SESSION_TIMEOUT_KEY, function (): int {
            $value = self::where('key', self::SESSION_TIMEOUT_KEY)->value('value');

            return self::normalizeSessionTimeout($value);
        });
    }

    public static function setSessionTimeoutMinutes(int $minutes): void
    {
        $minutes = self::normalizeSessionTimeout($minutes);

        self::updateOrCreate(
            ['key' => self::SESSION_TIMEOUT_KEY],
            ['value' => (string) $minutes],
        );

        Cache::forget(self::SESSION_TIMEOUT_KEY);
    }

    public static function normalizeSessionTimeout(mixed $value): int
    {
        $minutes = (int) ($value ?: config('session.lifetime', 20));

        return min(max($minutes, 5), 1440);
    }
}
