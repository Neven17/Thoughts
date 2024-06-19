<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)          //napravili smo kako bih imali prostup podacima o korisniku za metodu content kada se šalju podaci
    {
        //
        $this->user=$user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope         //header našeg maila         //config je definirano ime a '' je po defaultu
    {
        return new Envelope(
            subject: 'Thanks for joining' . config('app.name', ' '),    
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content      //ovo je što user vidi
    {
        return new Content(
            view: 'emails.welcome-email',
            with: [
                'user'=>$this->user,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array        //privitci        //public je ime foldera pa ide ime slike
    {
        return [         //Ovdje mogu ubaciti neku sliku
            //Attachment::fromStorageDisk('public', 'profile/FAQcTGjmWKtBafr4H6QcBwYhKitt5XhIEGaJ5Lmu.png'),      
        ];
    }
}
