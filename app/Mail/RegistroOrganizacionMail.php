<?php

namespace App\Mail;

use App\Models\Organizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroOrganizacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $organizacion;

    public function __construct(Organizacion $organizacion)
    {
        $this->organizacion = $organizacion;
    }

    public function build()
    {
        return $this
            ->subject('Registro de Organización')
            ->view('emails.registro-organizacion');
    }
}