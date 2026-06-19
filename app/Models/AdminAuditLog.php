<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAuditLog extends Model
{
    protected $fillable = [
        'super_admin_id',
        'super_admin_name',
        'action_type',
        'target_admin_name',
        'target_admin_email',
        'ip_address',
    ];

    public function superAdmin()
    {
        return $this->belongsTo(User::class, 'super_admin_id');
    }
}
