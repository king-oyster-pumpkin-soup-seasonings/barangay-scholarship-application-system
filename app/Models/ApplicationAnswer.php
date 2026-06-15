<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationAnswer extends Model
{
    protected $fillable = [
        'application_id',
        'requirement_id',
        'value',
        'file_path',
    ];

    // The application this answer belongs to
    /** @return BelongsTo<Application, $this> */ // application()
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    // The requirement this answer is responding to
    /** @return BelongsTo<ScholarshipRequirement, $this> */ // requirement()
    public function requirement(): BelongsTo
    {
        return $this->belongsTo(ScholarshipRequirement::class, 'requirement_id');
    }
}
