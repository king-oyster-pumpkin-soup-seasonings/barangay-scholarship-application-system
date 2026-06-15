<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // This scholarship's form fields/requirements
    public function requirements()
    {
        return $this->hasMany(ScholarshipRequirement::class);
    }

    // All applications submitted for this scholarship
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
