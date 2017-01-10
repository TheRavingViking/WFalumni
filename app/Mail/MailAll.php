<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailAll extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $title;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $email, $title)
    {
        $this->subject = $subject;
        $this->title = $title;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email/MailAll')->subject($this->subject);
    }
}
