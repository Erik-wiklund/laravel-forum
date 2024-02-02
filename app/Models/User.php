<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Messagable;

    // public function isOnline()
    // {
    //     // Define your criteria for determining if a user is online
    //     $onlineThreshold = now()->subMinutes(5); // For example, consider a user online if they were active in the last 5 minutes

    //     return $this->last_seen >= $onlineThreshold;
    // }

    public function repliesMade()
    {
        return $this->hasMany(Reply::class, 'user_id');
    }

    public function threadsStarted()
    {
        return $this->hasMany(Thread::class, 'created_by');
    }


    public function chatRooms()
    {
        return $this->belongsToMany(ChatRoom::class, 'user_chat_room');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function role()
    {
        return $this->belongsTo(User_role::class, 'role_id');
    }

    public function isAdmin()
    {
        return $this->role->name === 'Administrator';
    }

    public function isAdminOrMod()
    {
        return $this->role->name === 'Administrator' || $this->role->name === 'Moderator';
    }


    public function isMod()
    {
        $this->role->name === 'Moderator';
    }

    public function privateMessages()
    {
        return $this->belongsToMany(PrivateMessage::class, 'private_message_user', 'user_id', 'private_message_id');
    }

    public function hasUnreadMessages()
    {
        // Check if there are any private messages with unread replies for the user
        $unreadMessagesCount = $this->privateMessages()
            ->whereHas('privateMessageReplies', function ($query) {
                $query->whereJsonDoesntContain('has_read', $this->id);
            })
            ->count();

        return $unreadMessagesCount > 0;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'last_seen',
        'role_id',
        'image',
        'isforumbanned',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
