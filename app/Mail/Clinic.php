<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Clinic extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $userName;
    public $userPhone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$userName,$userPhone)
    {
        $this->data= $data;
        $this->userName= $userName;
        $this->userPhone= $userPhone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservation-clinic');
    }
}
