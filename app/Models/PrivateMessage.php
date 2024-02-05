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

    public function markMessagesAsRead($conversationId, $messageIds)
    {
        // Implement your logic to mark messages as read in this method
        // For example, update the database to track read messages
        // You should adapt this part to your specific database structure

        // Assuming you have a 'private_messages' table with a 'has_read' column
        PrivateMessage::where('conversation_id', $conversationId)
            ->whereNotIn('id', $messageIds)
            ->update(['has_read' => true]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'private_message_user')
            ->withPivot('has_read', 'created_at', 'updated_at');
    }

    public function hasUnreadMessages()
    {
        // Implement your logic to check if the conversation has unread messages
        // For example, check if there are unread replies in the conversation
        return $this->privateMessageReplies()->whereJsonDoesntContain('has_read', auth()->user()->id)->exists();
    }
}
