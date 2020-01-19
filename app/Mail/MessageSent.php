<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The message instance.
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from($this->message->email, $this->message->name)
                  ->subject($this->message->subject)
                  ->view('emails.contact.messageSent')
                  ->with([
                    'messageName' => $this->message->name,
                    'messageEmail' => $this->message->email,
                    'messageMobile' => $this->message->mobile,
                    'messageSubject' => $this->message->subject,
                    'messageContents' => $this->message->content,
                  ]);
    }
}
