<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailAll extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $email)
    {
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
        return $this->view('MailAll')->with([
                'title' => $this->email,
                'email' => $this->email,
            ]);
    }
}
