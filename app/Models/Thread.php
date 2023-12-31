<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'views_count',
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastPoster()
    {
        return $this->belongsTo(User::class, 'last_poster_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function incrementViewCount()
    {
        $this->increment('views_count');
    }

    public function lockedBy()
    {
        return $this->belongsTo(AdminLog::class, 'user_id');
    }

    public function adminLogs()
    {
        return $this->hasMany(AdminLog::class, 'thread_id');
    }

    public function admin()
    {
        return $this->belongsTo(AdminLog::class, 'user_id');
    }
}
