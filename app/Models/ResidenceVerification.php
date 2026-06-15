<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The admin who reviewed it
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
