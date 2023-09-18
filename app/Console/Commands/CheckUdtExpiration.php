<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Machine;
use Illuminate\Support\Facades\Mail;
use App\Mail\UdtExpired;

class CheckUdtExpiration extends Command
{
    protected $signature = 'udt:check';
    protected $description = 'Check UDT expiration and send email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $machines = Machine::all();

        foreach ($machines as $machine) {
            // Sprawdź czy data UDT minęła
            if (strtotime($machine->udt) <= strtotime(now())) {
                // Wyślij e-mail z powiadomieniem o przeterminowanym UDT
                Mail::to('karol.wisniewski2901@gmail.com')->send(new UdtExpired($machine));
            }
        }
    }
}
