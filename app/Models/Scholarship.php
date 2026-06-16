<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scholarship extends Model
{
    protected $fillable = [
        'title',
        'description',
        'allowance',
        'slots',
        'deadline',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'allowance' => 'decimal:2',
        ];
    }

    // The admin who created this scholarship
    /** @return BelongsTo<User, $this> */ // creator()
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // This scholarship's form fields/requirements
    /** @return HasMany<ScholarshipRequirement, $this> */ // requirements()
    public function requirements(): HasMany
    {
        return $this->hasMany(ScholarshipRequirement::class);
    }

    // All applications submitted for this scholarship
    /** @return HasMany<Application, $this> */ // applications()
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
