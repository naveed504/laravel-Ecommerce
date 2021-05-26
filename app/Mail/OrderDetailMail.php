<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDetailMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $orderdetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details , $orderdetail)
    {
        $this->details = $details;
        $this->orderdetail = $orderdetail ;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('wayshop.ordertempemail');
    }
}
