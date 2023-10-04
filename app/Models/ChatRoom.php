<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_chat_room');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function bannedUsers()
    {
        return $this->belongsToMany(User::class, 'chat_room_user_bans')->withTimestamps();
    }
}
