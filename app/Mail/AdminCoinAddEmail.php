<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminCoinAddEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $coin;

    public function __construct($coin)
    {
        $this->coin = $coin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@vista.network')
                    ->subject('Vista Network: Coins Received ')
                    ->view('mails.admin-coins-added')
                    ->attach(public_path('/assets/images/logo').'/logo.png', [
                              'as' => 'logo.png',
                              'mime' => 'image/png',
                    ]);
    }
}
