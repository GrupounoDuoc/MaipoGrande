<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $SendMail;

    public $id_pedido;
    
    public function __construct($id_pedido)
    {
        $this->id_pedido = $id_pedido;
    }

    public function build()
    {
        return $this->view('SendMail');
    }
}
