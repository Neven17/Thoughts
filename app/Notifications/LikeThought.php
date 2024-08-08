<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeThought extends Notification
{
    use Queueable;

    protected $user;
    protected $thought;

    public function __construct($user, $thought)
    {
        $this->user= $user;
        $this->thought= $thought;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    /*
    public function toMail( $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
*/
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray( $notifiable): array
    {
        return [
            'message' => "{$this->user->name} liked your thought.",
            'thought_id' => $this->thought->id,
            'user_id' => $this->user->id,
          
            
          
        ];
    }
}
