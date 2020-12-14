<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mailToVendedores extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $pedido;
    public $producto;
    public $comprador;
    public $cantidad;

    public function __construct($pedido,$producto,$comprador,$cantidad)
    {
        $this->pedido = $pedido;        
        $this->producto = $producto;
        $this->comprador = $comprador;
        $this->cantidad = $cantidad;
    }

    public function build()
    {
        return $this->view('sendMailVendedores');
    }
}
