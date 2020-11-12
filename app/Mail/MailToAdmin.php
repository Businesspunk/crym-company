<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    
    public $dataToSend;

    public function __construct( $data )
    {
        $this->dataToSend = $data;
    }
    
    public function build()
    {   
        return $this->subject('Сообщение с сайта')
                    ->view('mails.toAdmin', [
                        'name' => $this->dataToSend['name'],
                        'email' => $this->dataToSend['email'],
                        'messageToAdmin' => $this->dataToSend['message']
                    ]);
    }
}
