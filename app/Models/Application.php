<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The scholarship being applied to
    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    // The admin who reviewed this application
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // The user's submitted answers/files for each requirement
    public function answers()
    {
        return $this->hasMany(ApplicationAnswer::class);
    }

    // Timeline of status changes
    public function logs()
    {
        return $this->hasMany(ApplicationLog::class);
    }
}
