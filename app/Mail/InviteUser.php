<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $link;
    private $userMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $userMessage)
    {
        //
        $this->link = $link;
        $this->userMessage = $userMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('hi@awesomeapp.com')
                  ->subject('Invitation')
                  ->view('mail.invitation')
                  ->with(['user' => \Auth::user()->name, 'link' => $this->link, 'userMessage' => $this->userMessage]);
    }
}
