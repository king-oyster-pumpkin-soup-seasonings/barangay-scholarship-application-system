<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResidenceVerification extends Model
{
    protected $fillable = [
        'user_id',
        'valid_id_path',
        'proof_of_residency_path',
        'birth_certificate_path',
        'status',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
        ];
    }

    // The resident this belongs to
    /** @return BelongsTo<User, $this> */ // user()
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // The admin who reviewed it
    /** @return BelongsTo<User, $this> */ // reviewer()
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
