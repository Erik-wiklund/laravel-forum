<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessageReply extends Model
{
    use HasFactory;

    protected $table = 'private_message_user';

    protected $fillable = ['private_message_user', 'private_message_id', 'user_id'];

    protected $casts = [
        'has_read' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function privateMessage()
    {
        return $this->belongsTo(PrivateMessage::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function markAsReadByUser($userId)
    {
        $hasRead = $this->has_read ?? [];

        if (!in_array($userId, $hasRead)) {
            $hasRead[] = $userId;
            $this->has_read = $hasRead;
            $this->save();
        }
    }
}
