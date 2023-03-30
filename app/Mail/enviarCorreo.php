<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class enviarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Asunto del correo";
	public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // Se coloca la ruta donde se coloca el contenido del mensaje
    public function build()
    {
        return $this->view('contentMail');
    }
}
