<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShipmentMessagestoUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $ship;

    public function __construct($ship)
    {
        $this->ship = $ship;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@vista.network')
                    ->subject('Vista Network: Product Processed')
                    ->view('mails.shipping-processed')
                    ->attach(public_path('/assets/images/logo').'/logo.png', [
                              'as' => 'logo.png',
                              'mime' => 'image/png',
                    ]);
    }
}
