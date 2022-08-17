<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($anything)
    {
        $this->details = $anything;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    
    {
        return $this->subject('Mail Testing')
            ->view('emails.myTestMail');
    }
}
