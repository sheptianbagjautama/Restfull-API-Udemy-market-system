<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    // untuk verifikasi email
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct()
    public function __construct(User $user)
    {
        // Untuk verifikasi email
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome')->subject('Please confirm your account');
    }
}
