<?php

namespace App\Mail;

use App\Models\Organizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstadoOrganizacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $organizacion;

    public function __construct($organizacion)
    {
        $this->organizacion = $organizacion;
    }

    public function build()
    {
        return $this
            ->subject('Actualización de Estado de Expediente')
            ->view('emails.estado-organizacion');
    }
}
