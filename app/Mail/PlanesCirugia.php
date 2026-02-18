<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanesCirugia extends Mailable
{
    use Queueable, SerializesModels;


    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**l perfil
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('emails.plan_cirugia');
    }
}
