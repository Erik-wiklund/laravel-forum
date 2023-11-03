<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['reporter', 'reported_reply', 'reported_thread' , 'reason'];


    public function user()
    {
        return $this->belongsTo(User::class, 'reporter');
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class, 'reported_reply');
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
