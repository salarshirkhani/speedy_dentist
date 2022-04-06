<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserCredential extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * new user.
     *
     * @var App\Models\User
     */
    protected $user;

    /**
     * new user password.
     *
     * @var string
     */
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password = null)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registration successfull')
            ->markdown('emails.appointments.newuser', [
                'user' => $this->user,
                'password' => $this->password
            ]);
    }
}
