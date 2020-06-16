<?php

namespace App\Mail;

use App\SuspectCase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewNegative extends Mailable
{
    use Queueable, SerializesModels;

    public $suspectCase;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SuspectCase $suspectCase)
    {
        $this->suspectCase = $suspectCase;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.newnegative')->subject('Resultado de Examen');
    }
}
