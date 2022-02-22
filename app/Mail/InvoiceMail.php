<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $inv_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $inv_name)
    {
        $this->data = $data;
        $this->inv_name = $inv_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invoice_message')->attach(public_path('invoices/'.$this->inv_name));
    }
}
