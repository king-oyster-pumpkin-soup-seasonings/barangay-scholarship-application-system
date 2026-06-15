<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScholarshipRequirement extends Model
{
    protected $fillable = [
        'scholarship_id',
        'category',
        'field_type',
        'label',
        'options',
        'is_required',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'is_required' => 'boolean',
        ];
    }

    // The scholarship this requirement belongs to
    /** @return BelongsTo<Scholarship, $this> */ // scholarship()
    public function scholarship(): BelongsTo
    {
        return $this->belongsTo(Scholarship::class);
    }

    // All user answers submitted for this requirement
    /** @return HasMany<ApplicationAnswer, $this> */ // answers()
    public function answers(): HasMany
    {
        return $this->hasMany(ApplicationAnswer::class, 'requirement_id');
    }
}
