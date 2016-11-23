<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /*
        Type error: Argument 1 passed to App\Mail\ConfirmationEmail::__construct() must be an instance of App\Mail\App\User, instance of App\User given
    */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hi@awesomeapp.com')->subject('Confirmation Email')->view('mail.confirmation')->with(['user'=>$this->user]);
    }
}
