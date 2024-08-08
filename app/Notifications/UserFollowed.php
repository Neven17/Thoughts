<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $follower;

    /**
     * Create a new notification instance.
     *
     * @param $follower
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => "{$this->follower->name} is now following you.",
            'follower_id' => $this->follower->id,
        ];
    }
}
