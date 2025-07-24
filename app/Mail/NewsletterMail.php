<?php

namespace App\Mail;

use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class NewsletterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The post data.
     *
     * @var array
     */
    public $post;

    /**
     * The post type.
     *
     * @var string
     */
    public $type;

    /**
     * The subscriber email.
     *
     * @var string
     */
    public $subscriberEmail;

    /**
     * The unsubscribe link.
     *
     * @var string
     */
    public $unsubscribeLink;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $post
     * @param  string  $type
     * @param  string  $subscriberEmail
     */
    public function __construct($post, string $type, string $subscriberEmail)
    {
        $this->post = $post;
        $this->type = $type;
        $this->subscriberEmail = $subscriberEmail;
        
        // Ensure image_path has absolute URL
        if ($post && isset($post->image_path)) {
            // Store original image path
            $post->original_image_path = $post->image_path;
        }
        
        // Generate unsubscribe token
        $token = hash('sha256', $subscriberEmail . env('APP_KEY'));
        $this->unsubscribeLink = route('newsletter.unsubscribe', [
            'email' => $subscriberEmail,
            'token' => $token
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->type === 'berita' 
            ? 'Berita Baru: ' . $this->post->title
            : 'Pengumuman Baru: ' . $this->post->title;
            
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
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
