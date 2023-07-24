<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $phoneNumber;
    public $inquiry;
    public $reason;

    public function build()
    {
        return $this->subject('Confirmation: Your Inquiry has been received')
            ->view('emails.contact_email')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'phoneNumber' => $this->phoneNumber,
                'inquiry' => $this->inquiry,
                'reason' => $this->reason,
            ]);
    }

    public function __construct(
        $name,
        $email,
        $phoneNumber,
        $inquiry,
        $reason,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->inquiry = $inquiry;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Us Mail Confirmation',
        );
    }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
