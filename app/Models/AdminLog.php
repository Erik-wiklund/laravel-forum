<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    // Define the table name
    protected $table = 'admin_logs';

    // Define the fillable columns
    protected $fillable = ['user_id', 'action', 'resource_type', 'resource_id'];
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function targetUser()
    {
        return $this->belongsTo(User::class, 'resource_id');
    }
}
