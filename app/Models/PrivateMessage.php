<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{

    protected $casts = ['participants' => 'json'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lastPoster()
    {
        return $this->belongsTo(User::class, 'last_poster_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function privateMessageReplies()
    {
        return $this->hasMany(PrivateMessageReply::class);
    }

    
}
