<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'phone',
    'birthdate',
    'sex',
    'address',
    'verification_status',
    'verification_remarks',
    'verified_by',
    'verified_at',
])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthdate' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // One user has one residence verification record
    public function residenceVerification()
    {
        return $this->hasOne(ResidenceVerification::class);
    }

    // One user can submit many applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // One admin can create many scholarships
    public function scholarships()
    {
        return $this->hasMany(Scholarship::class, 'created_by');
    }

    // One admin can change the status of many applications (logs)
    public function applicationLogs()
    {
        return $this->hasMany(ApplicationLog::class, 'changed_by');
    }

    // One admin can post many announcements
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'created_by');
    }

    // The admin/superadmin who verified THIS user
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
