<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Subscriber extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $email;
    public function __construct($email)
    {
        //
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscriber',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        // return $this->from('theemail@gmail.com', 'Me')
        //     ->to($email, $name)
        //     ->view('emails.subscribers')
        //     ->with([
        //         'email' => $this->email
        //     ]);
        
        return $this
            ->subject('Thank you for subscribing to, Yalla NotLob!')
            ->markdown('emails.subscribers');

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
