<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UdtExpired extends Mailable
{
    use SerializesModels;

    public $machine;

    public function __construct($machine)
    {
        $this->machine = $machine;
    }

    public function build()
    {
        return $this->view('emails.udt_expired');
    }
}
