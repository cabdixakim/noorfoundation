<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $receipt;
    public $payment;

    public function __construct($receipt, $payment)
    {
        $this->receipt = $receipt;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  
        if($this->payment->status == 'confirmed'){

            return $this->markdown('Emails.PaymentConfirmed');
        } elseif($this->payment->status == 'delivered') {

            return $this->markdown('Emails.PaymentDelivered');
        }
    }
}
