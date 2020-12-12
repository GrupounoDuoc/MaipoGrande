<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionCreacion extends Mailable
{
    use Queueable, SerializesModels;

    public $MailCreacion;

    public function __construct()
    {

    }

    public function build()
    {
        return $this->view('MailCreacion');
    }
}
