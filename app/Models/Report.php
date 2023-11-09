<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter',
        'reported_reply',
        'reported_thread',
        'reason',
        'reported_private_conversation',
        'reported_private_messages',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'reporter');
    }

    public function reportss()
    {
        return $this->hasMany(Report::class);
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class, 'reported_reply');
    }

    public function conversation()
    {
        return $this->belongsTo(PrivateMessage::class, 'reported_private_conversation');
    }

    public function conversationMessages()
    {
        return $this->belongsTo(PrivateMessage::class, 'reported_private_messages');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'reported_thread');
    }

    public function reportedItem()
    {
        return $this->morphTo();
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportedItem');
    }
}
