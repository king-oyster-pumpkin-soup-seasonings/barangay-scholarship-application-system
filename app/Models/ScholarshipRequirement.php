<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    // All user answers submitted for this requirement
    public function answers()
    {
        return $this->hasMany(ApplicationAnswer::class, 'requirement_id');
    }
}
