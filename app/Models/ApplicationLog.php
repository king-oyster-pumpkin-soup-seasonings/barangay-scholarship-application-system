<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationLog extends Model
{
    // This table has no 'updated_at' column, so tell Laravel not to expect one
    const UPDATED_AT = null;

    protected $fillable = [
        'application_id',
        'old_status',
        'new_status',
        'changed_by',
        'notes',
    ];

    // The application this log entry belongs to
    /** @return BelongsTo<Application, $this> */ // application()
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    // The admin who made this status change
    /** @return BelongsTo<User, $this> */ // changedBy()
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
