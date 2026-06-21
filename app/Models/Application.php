<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_APPROVED = 'approved';

    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'scholarship_id',
        'status',
        'remarks',
        'submitted_at',
        'reviewed_by',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
        ];
    }

    // The resident who applied
    /** @return BelongsTo<User, $this> */ // user()
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // The scholarship being applied to
    /** @return BelongsTo<Scholarship, $this> */ // scholarship()
    public function scholarship(): BelongsTo
    {
        return $this->belongsTo(Scholarship::class);
    }

    // The admin who reviewed this application
    /** @return BelongsTo<User, $this> */ // reviewer()
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // The user's submitted answers/files for each requirement
    /** @return HasMany<ApplicationAnswer, $this> */ // answers()
    public function answers(): HasMany
    {
        return $this->hasMany(ApplicationAnswer::class);
    }

    // Timeline of status changes
    /** @return HasMany<ApplicationLog, $this> */ // logs()
    public function logs(): HasMany
    {
        return $this->hasMany(ApplicationLog::class);
    }

    public function canTransitionTo(string $status): bool
    {
        return $this->status === self::STATUS_PENDING
            && in_array($status, [self::STATUS_APPROVED, self::STATUS_REJECTED], true);
    }
}
