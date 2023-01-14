<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reset)
    {
        $this->url = route("forgot.password.reset", [
            "token" => $reset->token,
            "email" => $reset->email
        ]);
        $this->email = $reset->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.reset-password')
            ->subject("Request Reset Password");
    }
}