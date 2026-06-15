<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'body',
        'created_by',
    ];

    // The admin who posted this announcement
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
