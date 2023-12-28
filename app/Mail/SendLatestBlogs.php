<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendLatestBlogs extends Mailable
{
    use Queueable, SerializesModels;

    public $blogs;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($blogs,$pdfPath)
    {
        $this->blogs = $blogs;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Latest Blogs',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.send-latest-blog',
            with: ['blogs' => $this->blogs]
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
                    ->as('blogs.pdf')
                    ->withMime('application/pdf'),
        ];
    }
}
