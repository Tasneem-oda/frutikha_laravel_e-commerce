<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PharIo\Manifest\Email;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $message;
    public $phone;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$message,$phone , $subject)
    {
        //
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->phone = $phone;
        $this ->subject = $subject;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Contact Form Mail',
        );
    }
    
    public function bulid(){
        return $this -> view('contact')
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'message' => $this->message,
                        'phone' => $this->phone,
                        'subject' => $this->subject
                    ]);
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
