<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminEmailtoUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $admin;

    public function __construct($admin)
    {
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@vista.network')
                    ->subject('Vista Network: Message from Admin')
                    ->view('mails.admin-message')
                    ->attach(public_path('/assets/images/logo').'/logo.png', [
                              'as' => 'logo.png',
                              'mime' => 'image/png',
                    ]);
    }
}
