<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SurveyUntukAtasan extends Mailable
{
    use Queueable, SerializesModels;

    public $instansi;

    public function __construct($instansi)
    {
        $this->instansi = $instansi;
    }

    public function build()
    {
        return $this->subject('Permintaan Survei Atasan Alumni')
                    ->view('emails.survey_atasan');
    }
}