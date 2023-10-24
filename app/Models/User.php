<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // public function isOnline()
    // {
    //     // Define your criteria for determining if a user is online
    //     $onlineThreshold = now()->subMinutes(5); // For example, consider a user online if they were active in the last 5 minutes

    //     return $this->last_seen >= $onlineThreshold;
    // }


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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_seen',
        'role_id',
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
