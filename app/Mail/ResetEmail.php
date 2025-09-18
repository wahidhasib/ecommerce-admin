<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $bodyMessage;
    public $resetLink;

    /**
     * Create a new message instance.
     */
    public function __construct($subjectLine, $bodyMessage, $resetLink)
    {
        $this->subjectLine = $subjectLine;
        $this->bodyMessage = $bodyMessage;
        $this->resetLink   = $resetLink;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
            ->view('emails.reset-email')
            ->with([
                'bodyMessage' => $this->bodyMessage,
                'resetLink'   => $this->resetLink,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-email',
        );
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
