<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductPurchaseEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@vista.network')
                    ->subject('Vista Network: Product Buy Complete')
                    ->view('mails.product-purchase')
                    ->attach(public_path('/assets/images/logo').'/logo.png', [
                              'as' => 'logo.png',
                              'mime' => 'image/png',
                    ]);
    }
}
