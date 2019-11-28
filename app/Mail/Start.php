<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Start extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $startPlus;
    public $cars;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $data, $startPlus, $cars)
    {
        //
        $this->data = $data;
        $this->startPlus = $startPlus;
        $this->cars = $cars;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->from('webmaster@hyundai.ru')
                    ->view('mail.start');
    }
}
