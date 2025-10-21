<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageText;
    public $originalMessage;

    public function __construct($messageText, $originalMessage)
    {
        $this->messageText = $messageText;
        $this->originalMessage = $originalMessage;
    }

    public function build()
    {
        return $this->subject('Pengaduan - Dinas Kelautan dan Perikanan Provinsi Riau')
            ->view('emails.complaint')
            ->with([
                'messageText' => $this->messageText,
                'originalMessage' => $this->originalMessage,
            ]);
    }
}
