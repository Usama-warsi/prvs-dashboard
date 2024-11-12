<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tenantDataArray;

    public function __construct($tenantDataArray)
    {
        $this->tenantDataArray = $tenantDataArray;
    }

    public function build()
    {
        return $this->view('plugins/ecommerce::orders.email')
                    ->with(['tenantDataArray' => $this->tenantDataArray]);
    }
}
