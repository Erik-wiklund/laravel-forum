<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class MentionSuccessful extends Notification
{
    use Queueable;

    /**
     * The ID of the user who mentioned the current user.
     *
     * @var int
     */
    protected $mentioningUserId;

    /**
     * Create a new notification instance.
     *
     * @param int $mentioningUserId
     * @return void
     */
    public function __construct($mentioningUserId)
    {
        $this->mentioningUserId = $mentioningUserId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        // Get the user who mentioned the current user
        $mentioningUser = User::find($this->mentioningUserId);

        // Check if the user was found and has a username
        if ($mentioningUser && $mentioningUser->username) {
            $mentioningUsername = $mentioningUser->username;
            return [
                'data' => 'You were mentioned by ' . $mentioningUsername . ' In the shoutbox',
            ];
        } else {
            return [
                'data' => 'You were mentioned by a user',
            ];
        }
    }
}
